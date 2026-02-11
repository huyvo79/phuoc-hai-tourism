@extends('layouts.layouts')

@section('title', $post->title)
@section('body_class', 'page-single')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/single.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* CSS bổ sung để đảm bảo video luôn responsive */
        .post-main-content iframe {
            max-width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
        }
    </style>

    <div class="page-content">
        <div class="container">
            <div class="content post-main-content">
                {{-- Title --}}
                <h1>{{ $post->title }}</h1>

                {{-- Thumbnail --}}
                @if(!empty($post->thumbnail))
                    <div class="main-thumbnail">
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" style="width: 100%; height: auto;">
                    </div>
                @endif

                {{-- Nội dung bài viết: Render video/HTML từ TinyMCE --}}
                <div class="article-body">
                    @if(!empty($post->content))
                        {!! $post->content !!}
                    @else
                        <p>Nội dung đang được cập nhật.</p>
                    @endif
                </div>

                {{-- Google Map --}}
                @if(!empty($post->latitude) && !empty($post->longitude))
                    <div class="map-container" style="margin-top: 30px;">
                        <iframe width="100%" height="400" style="border:0" loading="lazy" allowfullscreen
                            src="https://maps.google.com/maps?q={{ $post->latitude }},{{ $post->longitude }}&hl=vi&z=14&output=embed">
                        </iframe>
                    </div>
                @endif
            </div>

            <aside class="sidebar">
                <h2>Bài viết liên quan</h2>
                <div class="related-list">
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
                </div>
            </aside>
        </div>
    </div>
@endsection