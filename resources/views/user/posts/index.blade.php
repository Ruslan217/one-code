@extends('layouts.main')

@section('page.title', 'Мои посты')

@section('main.content')
    <x-title>
        {{ __('Мои посты') }}

        <x-slot name="right">
            <x-button-link href="{{ route('user.posts.create') }}">
                {{ __('Создать') }}
            </x-button-link>
        </x-slot>
    </x-title>

    @if($posts->isEmpty())
        {{ __('Нет ни одного поста.') }}
    @else
        <form action="{{ route('user.posts.delete') }}" method="POST" onsubmit="return confirm('{{ __('Вы уверены, что хотите удалить выбранные посты?') }}');">
            @csrf
            @method('DELETE')

            @foreach($posts as $post)
                <div class="mb-3 d-flex align-items-center">
                    <input type="checkbox" name="posts[]" value="{{ $post->id }}" class="mr-2">
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

            <button type="submit" class="btn btn-danger">
                {{ __('Удалить выбранные') }}
            </button>
        </form>

        {{ $posts->links() }}
    @endif
@endsection
