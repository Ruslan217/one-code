@extends('layouts.main')

@section('page.title', 'Мои посты')

@section('main.content')
    <x-title>
        {{ __('Мои посты') }}

        <x-slot name="right">
            <x-button-link href="{{ route('user.posts.create') }}">
                {{ __('Создать') }}
            </x-button-link>
            <button id="toggle-checkboxes" type="button" class="btn btn-primary ml-2">
                {{ __('Выбрать') }} </button>
        </x-slot>
    </x-title>

    @if($posts->isEmpty())
        {{ __('Нет ни одного поста.') }}
    @else
        <form action="{{ route('user.posts.delete') }}" method="POST" onsubmit="return confirm('{{ __('Вы уверены, что хотите удалить выбранные посты?') }}');">
            @csrf
            @method('DELETE')

            <div id="posts-container">
                @foreach($posts as $post)
                    <div class="mb-3 d-flex align-items-center">
                        <input type="checkbox" name="posts[]" value="{{ $post->id }}" class="mr-2 post-checkbox" hidden>
                        <div>
                            <h2 class="h6 mb-1">
                                <a href="{{ route('user.posts.show', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <div class="small text-muted">
                                {{ $post->published_at?->format('d.m.Y H:i:s') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-danger" disabled id="delete-selected">
                {{ __('Удалить выбранные') }}
            </button>
        </form>

        {{ $posts->links() }}
    @endif

    <script>
        const toggleButton = document.getElementById('toggle-checkboxes');
        const postCheckboxes = document.querySelectorAll('.post-checkbox');
        const deleteButton = document.getElementById('delete-selected');

        // Initially hide the delete button and disable it
        deleteButton.style.display = 'none';
        deleteButton.disabled = true;

        toggleButton.addEventListener('click', () => {
            postCheckboxes.forEach(checkbox => checkbox.hidden = !checkbox.hidden);
        });

        postCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let anyChecked = false; // Assume none are checked initially

                // Loop through checkboxes to see if any are checked
                for (let i = 0; i < postCheckboxes.length; i++) {
                    if (postCheckboxes[i].checked) {
                        anyChecked = true;
                        break; // Exit loop if a checked box is found
                    }
                }

                // Show the button and enable it if at least one checkbox is checked, otherwise hide and disable it
                if (anyChecked) {
                    deleteButton.style.display = 'inline-block';
                    deleteButton.disabled = false;
                } else {
                    deleteButton.style.display = 'none';
                    deleteButton.disabled = true;
                }
            });
        });


    </script>

@endsection
