@include('partials.alert')

<div class="pb-6">
    <div class="box" x-data="{ visible: localStorage.getItem('journal-write-visible') === 'true' }">
        <div
            class="box-header flex justify-between cursor-pointer"
            @click="
                    localStorage.setItem('journal-write-visible', !visible);
                    visible = !visible;
                "
        >
            Write in my journal

            <img
                class="w-4 h-4 block transform transition-transform duration-200 rotate-180 ease-in"
                :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
            />
        </div>

        <div class="box-inside" x-show.transition="visible">
            <form action="{{ route('bullet.store') }}" method="POST">
                @csrf

                <div class="form-field">
                    <textarea
                        class="form-textarea w-full @error('bullet') error @enderror"
                        name="bullet"
                        id="bullet-input"
                        autofocus
                        rows="3"
                    ></textarea>

                    @error('bullet')
                    <p>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button class="button w-full">Add to my journal</button>
            </form>
        </div>
    </div>


    @foreach($bullets as $date => $values)
        <div
            x-data="{ visible: parseInt('{{ $date === now(auth()->user()->timezone)->format('d M y') }}') === 1, editBullet: false }"
        >
            <h3
                class="p-3 my-6 w-full bg-indigo-400 rounded-lg font-bold text-white cursor-pointer flex justify-between items-center select-none border-4 border-indigo-400"
                @click="visible = !visible"
            >
                {{ $date }}

                <img
                    class="w-4 h-4 block transform transition-transform duration-200 ease-in rotate-180"
                    :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
                />
            </h3>

            @foreach($values as $bullet)
                <div class="mt-6" x-show.transition="visible === true"> <!-- Bullet -->
                    <p
                        x-show="!(editBullet === {{ $bullet->id }})" class="mb-6"
                    > <!-- Text -->
                        {{ $bullet->bullet }}
                    </p>

                    <form
                        id="edit-bullet-{{ $bullet->id }}"
                        action="{{ route('bullet.update', ['id' => $bullet->id]) }}"
                        x-show="editBullet === {{ $bullet->id }}" class="mb-6"
                        method="POST"
                    > <!-- Edit field -->
                        @csrf

                        <input type="hidden" name="_method" value="PUT">

                        <textarea
                            class="form-textarea w-full @error('bullet') error @enderror"
                            name="bullet"
                            autofocus
                            rows="3"
                        >{{ $bullet->bullet }}</textarea>
                    </form>

                    <div
                        class="flex justify-between block w-full mb-3 text-sm"
                    >
                        <button
                            class="select-none cursor-pointer hover:text-indigo-400 ease-in duration-100 transition-colors flex items-center"
                            x-show="editBullet === {{ $bullet->id }}"
                            @click="event.preventDefault(); document.querySelector('#edit-bullet-{{ $bullet->id }}').submit();"
                            type="submit"
                        > <!-- Save -->
                            <svg
                                class="block w-5 h-5 mr-2"
                                fill="#000000"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                width="32px"
                                height="32px"
                            >
                                <path
                                    d="M 2.59375 1 C 1.71875 1 1 1.71875 1 2.59375 L 1 12.40625 C 1 13.28125 1.71875 14 2.59375 14 L 12.40625 14 C 13.28125 14 14 13.28125 14 12.40625 L 14 4.042969 L 10.957031 1 Z M 2.59375 2 L 3 2 L 3 5 C 3 5.546875 3.453125 6 4 6 L 10 6 C 10.546875 6 11 5.546875 11 5 L 11 2.457031 L 13 4.457031 L 13 12.40625 C 13 12.742188 12.738281 13 12.40625 13 L 11 13 L 11 10 C 11 9.453125 10.546875 9 10 9 L 5 9 C 4.453125 9 4 9.453125 4 10 L 4 13 L 2.59375 13 C 2.257813 13 2 12.738281 2 12.40625 L 2 2.59375 C 2 2.257813 2.257813 2 2.59375 2 Z M 4 2 L 7 2 L 7 4 L 9 4 L 9 2 L 10 2 L 10 5 L 4 5 Z M 5 10 L 10 10 L 10 13 L 5 13 Z"
                                />
                            </svg>

                            Save
                        </button>

                        <button
                            class="select-none cursor-pointer hover:text-indigo-400 ease-in duration-100 transition-colors flex items-center"
                            x-show="editBullet === {{ $bullet->id }}"
                            @click="editBullet = false"
                        > <!-- Cancel -->
                            <svg
                                class="block w-5 h-5 mr-2"
                                fill="#000000"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                width="32px"
                                height="32px"
                            >
                                <path
                                    d="M 7.5 1 C 3.917969 1 1 3.917969 1 7.5 C 1 11.082031 3.917969 14 7.5 14 C 11.082031 14 14 11.082031 14 7.5 C 14 3.917969 11.082031 1 7.5 1 Z M 7.5 2 C 10.542969 2 13 4.457031 13 7.5 C 13 10.542969 10.542969 13 7.5 13 C 4.457031 13 2 10.542969 2 7.5 C 2 4.457031 4.457031 2 7.5 2 Z M 5.5 4.792969 L 4.792969 5.5 L 5.148438 5.851563 L 6.792969 7.5 L 5.148438 9.148438 L 4.792969 9.5 L 5.5 10.207031 L 5.851563 9.851563 L 7.5 8.207031 L 9.148438 9.851563 L 9.5 10.207031 L 10.207031 9.5 L 9.851563 9.148438 L 8.207031 7.5 L 9.851563 5.851563 L 10.207031 5.5 L 9.5 4.792969 L 9.148438 5.148438 L 7.5 6.792969 L 5.851563 5.148438 Z"
                                />
                            </svg>

                            Cancel
                        </button>

                        <button
                            class="select-none cursor-pointer hover:text-indigo-400 ease-in duration-100 transition-colors flex items-center"
                            x-show="!(editBullet === {{ $bullet->id }})" class="mb-6"
                            @click="editBullet === {{ $bullet->id }} ? editBullet = false : editBullet = {{ $bullet->id }}"
                        > <!-- Edit -->
                            <svg
                                class="block w-5 h-5 mr-2"
                                fill="#000000"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                width="32px"
                                height="32px"
                            >
                                <path
                                    d="M 12.03125 2.023438 C 11.535156 2.023438 11.066406 2.269531 10.675781 2.65625 L 2.5625 10.726563 L 1.207031 14.785156 L 5.265625 13.433594 L 5.351563 13.351563 L 13.386719 5.367188 C 13.773438 4.976563 14.015625 4.507813 14.015625 4.011719 C 14.015625 3.515625 13.773438 3.046875 13.386719 2.65625 C 12.996094 2.269531 12.527344 2.023438 12.03125 2.023438 Z M 10.027344 4.710938 L 11.320313 6.007813 L 4.726563 12.5625 L 2.789063 13.207031 L 3.4375 11.265625 Z"
                                />
                            </svg>


                            Edit
                        </button>

                        <form
                            action="{{ route('bullet.delete', ['id' => $bullet->id]) }}"
                            method="POST"
                            x-show="!(editBullet === {{ $bullet->id }})"
                        > <!-- Delete -->
                            @csrf

                            <input type="hidden" name="_method" value="DELETE">

                            <button
                                class="select-none cursor-pointer hover:text-red-400 ease-in duration-100 transition-colors flex items-center"
                                type="submit"
                            >
                                <svg
                                    class="block w-5 h-5 mr-2"
                                    fill="#000000"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    width="32px"
                                    height="32px"
                                >
                                    <path
                                        d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.324219 3.675781 14 4.5 14 L 10.5 14 C 11.324219 14 12 13.324219 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 4 4 L 11 4 L 11 12.5 C 11 12.78125 10.78125 13 10.5 13 L 4.5 13 C 4.21875 13 4 12.78125 4 12.5 Z M 5 5 L 5 12 L 6 12 L 6 5 Z M 7 5 L 7 12 L 8 12 L 8 5 Z M 9 5 L 9 12 L 10 12 L 10 5 Z"
                                    />
                                </svg>

                                Delete
                            </button>
                        </form>

                        <div
                            class="flex items-center block"
                        > <!-- Published at -->
                            <svg
                                class="block w-5 h-5 mr-2"
                                fill="#000000"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                width="32px"
                                height="32px"
                            >
                                <path
                                    d="M 3 1 L 3 2 L 2.5 2 C 1.675781 2 1 2.675781 1 3.5 L 1 8 L 2 8 L 2 6 L 13 6 L 13 12.5 C 13 12.78125 12.78125 13 12.5 13 L 2.5 13 C 2.21875 13 2 12.78125 2 12.5 L 2 11 L 1 11 L 1 12.5 C 1 13.324219 1.675781 14 2.5 14 L 12.5 14 C 13.324219 14 14 13.324219 14 12.5 L 14 3.5 C 14 2.675781 13.324219 2 12.5 2 L 12 2 L 12 1 L 11 1 L 11 2 L 4 2 L 4 1 Z M 2.5 3 L 3 3 L 3 4 L 4 4 L 4 3 L 11 3 L 11 4 L 12 4 L 12 3 L 12.5 3 C 12.78125 3 13 3.21875 13 3.5 L 13 5 L 2 5 L 2 3.5 C 2 3.21875 2.21875 3 2.5 3 Z M 4 7 L 4 9 L 1 9 L 1 10 L 4 10 L 4 12 L 6.5 9.5 Z"
                                />
                            </svg>

                            {{ $bullet->published_at->format('h:i:s') }}
                        </div>
                    </div>

                    <span class="block w-full h-1 bg-gray-400 rounded-full" />
                </div>
            @endforeach
        </div>
    @endforeach
</div>
