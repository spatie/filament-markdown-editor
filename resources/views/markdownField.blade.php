<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
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
        x-data="{ state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }} }"
        x-init="
            editor = new EasyMDE({
                autoDownloadFontAwesome: false,
                element: $refs.editor,
                uploadImage: true,
                placeholder: @js(__('Start writing…')),
                initialValue: state ?? '',
                spellChecker: false,
                autoSave: false,
                status: [{
                    className: 'upload-image',
                    defaultValue: ''
                }],
                toolbar: [
                    'heading', 'bold', 'italic', 'link',
                    '|',
                    'quote', 'unordered-list', 'ordered-list', 'table',
                    '|',
                    {
                        name: 'upload-image',
                        action: EasyMDE.drawUploadedImage,
                        className: 'fa fa-image',
                    },
                    'undo',
                    { // When FontAwesome is not auto downloaded, this loads the correct icon
                        name: 'redo',
                        action: EasyMDE.redo,
                        className: 'fa fa-redo',
                        title: 'Redo',
                    },
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
                        $wire.getComponentFileAttachmentUrl('{{ $getStatePath() }}').then((url) => {
                            if (! url) {
                                return onError('File could not be uploaded');
                            }

                            onSuccess(url);
                        })
                    });
                },
            });

            editor.codemirror.on('change', debounce(() => {
                state = editor.value();
            }));

            $watch('state', () => {
                if (editor.codemirror.hasFocus()) {
                    return;
                }

                editor.value(state ?? '');
            });
        "
        wire:ignore
    >
        <textarea x-ref="editor"></textarea>
    </div>
</x-forms::field-wrapper>
