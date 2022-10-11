@once
    {{-- <script src="{{ asset('vendor/mailcoach-markdown-editor/editor.js') }}" defer></script>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endonce

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
    <div
        wire:model.lazy="{{ $getStatePath() }}"
    >

        <div class="form-grid">
            <style>
                .cm-s-easymde .cm-header-1 {
                    font-size: 1.875rem
                }

                .cm-s-easymde .cm-header-2 {
                    font-size: 1.5rem
                }

                .cm-s-easymde .cm-header-3 {
                    font-size: 1.25rem
                }

                .cm-s-easymde .cm-header-4 {
                    font-size: 1.125rem
                }

                .cm-s-easymde .cm-header-5 {
                    font-size: 1.125rem
                }

                .cm-s-easymde .cm-header-6 {
                    font-size: 1rem
                }

                .cm-s-easymde .cm-comment {
                    background: none;
                }

                .cm-keyword {
                    color: #708;
                }

                .cm-atom {
                    color: #219;
                }

                .cm-number {
                    color: #164;
                }

                .cm-def {
                    color: #00f;
                }

                .cm-variable,
                .cm-punctuation,
                .cm-property,
                .cm-operator {
                }

                .cm-variable-2 {
                    color: #05a;
                }

                .cm-formatting-list, .cm-formatting-list + .cm-variable-2 {
                    color: #000;
                }

                .cm-variable-3, .cm-s-default .cm-type {
                    color: #085;
                }

                .cm-comment {
                    color: #a50;
                }

                .cm-string {
                    color: #a11;
                }

                .cm-string-2 {
                    color: #f50;
                }

                .cm-meta {
                    color: #555;
                }

                .cm-qualifier {
                    color: #555;
                }

                .cm-builtin {
                    color: #30a;
                }

                .cm-bracket {
                    color: #997;
                }

                .cm-tag {
                    color: #170;
                }

                .cm-attribute {
                    color: #00c;
                }

                .cm-hr {
                    color: #999;
                }

                .cm-link {
                    color: #00c;
                }
            </style>
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

                window.init = function () {
                    let editor = new EasyMDE({
                        autoDownloadFontAwesome: false,
                        element: this.$refs.editor,
                        uploadImage: true,
                        placeholder: '{{ __('Start writing…') }}',
                        initialValue: this.markdown,
                        spellChecker: false,
                        autoSave: false,
                        status: [{
                            className: "upload-image",
                            defaultValue: ''
                        }],
                        toolbar: [
                            "heading", "bold", "italic", "link",
                            "|",
                            "quote", "unordered-list", "ordered-list", "table",
                            "|",
                            {
                                name: "upload-image",
                                action: EasyMDE.drawUploadedImage,
                                className: "fa fa-image",
                            },
                            "undo",
                            { // When FontAwesome is not auto downloaded, this loads the correct icon
                                name: "redo",
                                action: EasyMDE.redo,
                                className: "fa fa-redo",
                                title: "Redo",
                            },
                        ],
                        {{--
                            imageAccept: 'image/png, image/jpeg, image/gif, image/avif',
                            imageUploadFunction: function(file, onSuccess, onError) {
                                if (file.size > 1024 * 1024 * 2) {
                                    return onError('File cannot be larger than 2MB.');
                                }

                                if (file.type.split('/')[0] !== 'image') {
                                    return onError('File must be an image.');
                                }

                                const data = new FormData();
                                data.append('file', file);

                                fetch('{{ action(\Spatie\Mailcoach\Http\Api\Controllers\UploadsController::class) }}', {
                                    method: 'POST',
                                    body: data,
                                    credentials: 'same-origin',
                                    headers: {
                                        'X-CSRF-Token': '{{ csrf_token() }}',
                                    },
                                })
                                    .then(response => response.json())
                                    .then(({ success, file }) => {
                                        if (! success) {
                                            return onError();
                                        }

                                        onSuccess(file.url);
                                    });
                            },

                            --}}
                    });

                    editor.codemirror.on("change", debounce(() => {
                        this.markdown = editor.value();
                        this.$refs.editor.dirty = true;
                    }));
                }
            </script>

            {{--
            @if($label ?? null)
                <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }} -mb-4" for="{{ $name }}">
                    {{ $label }}
                </label>
            @endif
            --}}
            @php($wireModelAttribute = collect($attributes)->first(fn (string $value, string $attribute) => str_starts_with($attribute, 'wire:model')))
            <div class="markup markup-editor markup-lists markup-links markup-code"
                 wire:ignore x-data="{
            markdown: @entangle($getStatePath),
            init: init,
        }">
                <textarea x-ref="editor" data-dirty-check></textarea>
            </div>
        </div>
    </div>
</x-forms::field-wrapper>
