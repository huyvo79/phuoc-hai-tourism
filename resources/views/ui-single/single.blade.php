@extends('layouts.layouts')

@section('title', $post->title)
@section('body_class', 'page-single')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/single.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="page-content">
        <div class="container">

            <!-- ===== BÀI VIẾT CHÍNH ===== -->
            <div class="content">

                {{-- Title --}}
                <h1>{{ $post->title }}</h1>

                {{-- Thumbnail --}}
                @if(!empty($post->thumbnail))
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
                @endif

                {{-- Nội dung bài viết (HTML từ CKEditor) --}}
                @if(!empty($post->content))
                    {!! $post->content !!}
                @else
                    <p>Nội dung đang được cập nhật.</p>
                @endif

                {{-- Google Map (nếu có iframe lưu trong DB) --}}
                @if(!empty($post->map_iframe))
                    <div class="post-map">
                        {!! $post->map_iframe !!}
                    </div>
                @endif

            </div>

            <!-- ===== BÀI VIẾT LIÊN QUAN ===== -->
            <aside class="sidebar">
                <h2>Bài viết liên quan</h2>

                @forelse($post->relatedPosts as $related)
                    <a href="{{ route('posts.show', $related->slug) }}" class="related-item">
                        @if(!empty($related->thumbnail))
                            <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}">
                        @endif
                        <h4>{{ $related->title }}</h4>
                    </a>
                @empty
                    <p>Chưa có bài viết liên quan</p>
                @endforelse

            </aside>
        </div>
    </div>

@endsection
