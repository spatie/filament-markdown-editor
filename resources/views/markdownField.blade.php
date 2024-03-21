<x-filament-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <script>
        function debounce(func, timeout = 300) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }
    </script>

    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }}, editor: null }"
        x-init="
            editor = new EasyMDE({
                autoDownloadFontAwesome: false,
                element: $refs.editor,
                uploadImage: true,
                placeholder: @js(__($getPlaceholder() ?? 'Start writing…')),
                initialValue: state ?? '',
                spellChecker: false,
                autoSave: false,
                status: [{
                    className: 'upload-image',
                    defaultValue: ''
                }],
                toolbar: [
                @if($hasToolbarButton('heading'))
                    'heading',
                @endif
                @if($hasToolbarButton('bold'))
                    'bold',
                @endif
                @if($hasToolbarButton('italic'))
                    'italic',
                @endif
                @if($hasToolbarButton('link'))
                    'link',
                @endif
                @if($hasToolbarButton('quote'))
                    'quote',
                @endif
                @if($hasToolbarButton('unordered-list'))
                    'unordered-list',
                @endif
                @if($hasToolbarButton('ordered-list'))
                    'ordered-list',
                @endif
                @if($hasToolbarButton('table'))
                    'table',
                @endif
                @if($hasToolbarButton('upload-image'))
                    {
                        name: 'upload-image',
                        action: EasyMDE.drawUploadedImage,
                        className: 'fa fa-image',
                    },
                @endif
                @if($hasToolbarButton('undo'))
                    'undo',
                @endif
                @if($hasToolbarButton('redo'))
                    { // When FontAwesome is not auto downloaded, this loads the correct icon
                        name: 'redo',
                        action: EasyMDE.redo,
                        className: 'fa fa-redo',
                        title: 'Redo',
                    },
                @endif
                ],
                imageAccept: 'image/png, image/jpeg, image/gif, image/avif',
                imageUploadFunction: function(file, onSuccess, onError) {
                    if (file.size > 1024 * 1024 * 2) {
                        return onError('File cannot be larger than 2MB.');
                    }

                    if (file.type.split('/')[0] !== 'image') {
                        return onError('File must be an image.');
                    }

                    $wire.upload(`componentFileAttachments.{{ $getStatePath() }}`, file, () => {
                        $wire.getFormComponentFileAttachmentUrl('{{ $getStatePath() }}').then((url) => {
                            if (! url) {
                                return onError('File could not be uploaded');
                            }

                            onSuccess(url);
                        })
                    });
                },
            });
            
            // 'Create Link (Ctrl-K)': highlight URL instead of label:
            editor.codemirror.on('changes', (instance, changes) => {
                try {
                    // Grab the last change from the buffered list. I assume the
                    // buffered one ('changes', instead of 'change') is more efficient,
                    // and that 'Create Link' will always end up last in the list.
                    const lastChange = changes[changes.length - 1];
                    if (lastChange.origin === '+input') {
                        // https://github.com/Ionaru/easy-markdown-editor/blob/8fa54c496f98621d5f45f57577ce630bee8c41ee/src/js/easymde.js#L765
                        const EASYMDE_URL_PLACEHOLDER = '(https://)';
                        // The URL placeholder is always placed last, so just look at the
                        // last text in the array to also cover the multi-line case:
                        const urlLineText = lastChange.text[lastChange.text.length - 1];
                        if (urlLineText.endsWith(EASYMDE_URL_PLACEHOLDER) && urlLineText !== '[]' + EASYMDE_URL_PLACEHOLDER) {
                            const from = lastChange.from;
                            const to = lastChange.to;
                            const isSelectionMultiline = lastChange.text.length > 1;
                            const baseIndex = isSelectionMultiline ? 0 : from.ch;
                            // Everything works fine for the [Ctrl-K] case, but for the
                            // [Button] case, this handler happens before the original
                            // code, thus our change got wiped out.
                            // Add a small delay to handle that case.
                            setTimeout(() => {
                                instance.setSelection(
                                    { line: to.line, ch: baseIndex + urlLineText.lastIndexOf('(') + 1 },
                                    { line: to.line, ch: baseIndex + urlLineText.lastIndexOf(')') }
                                );
                            }, 25);
                        }
                    }
                } catch (err) {
                    // Do nothing (revert to original behavior)
                }
            });

            editor.codemirror.on('change', debounce(() => {
                state = editor.value();
            }));

            $watch('state', () => {
                if (editor.codemirror.hasFocus()) {
                    return;
                }

                editor.value(state ?? null);
            });
        "
        wire:ignore
    >
        <textarea x-ref="editor"></textarea>
    </div>
</x-filament-forms::field-wrapper>
