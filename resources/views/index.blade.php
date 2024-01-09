@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="main-content__box">
                <h4>{{ __('New Posts') }}</h4>
                <div class="main-content__list-item">
                    @foreach ($newPosts as $item)
                        <a href="{{ route('detail', ['id' => $item->id]) }}" class="main-content__item">
                            <div class="w-100 h-100 main-container__item">
                                <div class="info-post-item d-flex">
                                    <img src="{{ asset(!empty($item->user->avatar) ? $item->user->avatar : 'images/avatar_default.png') }}"
                                        title="Avatar của {{ $item->user->name }}" alt="">
                                    <div>
                                        <h5 class="info-post-verify">
                                            {{ $item->user->name }}
                                            @if ($item->user->verify)
                                                <svg viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z"
                                                        fill="#1d9bf0"></path>
                                                </svg>
                                            @endif
                                        </h5>
                                        @if ($item->verify)
                                            <span class="verifyText">{{ __('This post had been verified') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <h5 class="ml-2">{{ $item->title }}</h5>
                                <div class="d-flex justify-content-between">
                                    <span class="item-footer">{{ formatDate($item->created_at) }}</span>
                                    <div class="d-flex item-footer">
                                        <div style="margin-right: 5px">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                                <title>ic_fluent_comment_24_regular</title>
                                                <desc>Created with Sketch.</desc>
                                                <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="ic_fluent_comment_24_regular" fill="#212121" fill-rule="nonzero">
                                                        <path
                                                            d="M5.25,18 C3.45507456,18 2,16.5449254 2,14.75 L2,6.25 C2,4.45507456 3.45507456,3 5.25,3 L18.75,3 C20.5449254,3 22,4.45507456 22,6.25 L22,14.75 C22,16.5449254 20.5449254,18 18.75,18 L13.0124851,18 L7.99868152,21.7506795 C7.44585139,22.1641649 6.66249789,22.0512036 6.2490125,21.4983735 C6.08735764,21.2822409 6,21.0195912 6,20.7499063 L5.99921427,18 L5.25,18 Z M12.5135149,16.5 L18.75,16.5 C19.7164983,16.5 20.5,15.7164983 20.5,14.75 L20.5,6.25 C20.5,5.28350169 19.7164983,4.5 18.75,4.5 L5.25,4.5 C4.28350169,4.5 3.5,5.28350169 3.5,6.25 L3.5,14.75 C3.5,15.7164983 4.28350169,16.5 5.25,16.5 L7.49878573,16.5 L7.49899997,17.2497857 L7.49985739,20.2505702 L12.5135149,16.5 Z"
                                                            id="🎨-Color">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                            {{ $item->reviews->count() }}
                                        </div>
                                        <div style="margin-left: 5px">
                                            <svg fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42 42"
                                                enable-background="new 0 0 42 42" xml:space="preserve">
                                                <path
                                                    d="M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
                                                                                    C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
                                                                                    C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z" />
                                            </svg>
                                            {{ $item->views }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="main-content__box">
                <h4>{{ __('Authenticated Posts') }}</h4>
                <div class="main-content__list-item">
                    @foreach ($authenticatedPosts as $item)
                        <a href="{{ route('detail', ['id' => $item->id]) }}" class="main-content__item">
                            <div class="w-100 h-100 main-container__item">
                                <div class="info-post-item d-flex">
                                    <img src="{{ asset(!empty($item->user->avatar) ? $item->user->avatar : 'images/avatar_default.png') }}"
                                        title="Avatar của {{ $item->user->name }}" alt="">
                                    <div>
                                        <h5 class="info-post-verify">
                                            {{ $item->user->name }}
                                            @if ($item->user->verify)
                                                <svg viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z"
                                                        fill="#1d9bf0"></path>
                                                </svg>
                                            @endif
                                        </h5>
                                        @if ($item->verify)
                                            <span class="verifyText">{{ __('This post had been verified') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <h5 class="ml-2">{{ $item->title }}</h5>
                                <div class="d-flex justify-content-between">
                                    <span class="item-footer">{{ formatDate($item->created_at) }}</span>
                                    <div class="d-flex item-footer">
                                        <div style="margin-right: 5px">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                                <title>ic_fluent_comment_24_regular</title>
                                                <desc>Created with Sketch.</desc>
                                                <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="ic_fluent_comment_24_regular" fill="#212121" fill-rule="nonzero">
                                                        <path
                                                            d="M5.25,18 C3.45507456,18 2,16.5449254 2,14.75 L2,6.25 C2,4.45507456 3.45507456,3 5.25,3 L18.75,3 C20.5449254,3 22,4.45507456 22,6.25 L22,14.75 C22,16.5449254 20.5449254,18 18.75,18 L13.0124851,18 L7.99868152,21.7506795 C7.44585139,22.1641649 6.66249789,22.0512036 6.2490125,21.4983735 C6.08735764,21.2822409 6,21.0195912 6,20.7499063 L5.99921427,18 L5.25,18 Z M12.5135149,16.5 L18.75,16.5 C19.7164983,16.5 20.5,15.7164983 20.5,14.75 L20.5,6.25 C20.5,5.28350169 19.7164983,4.5 18.75,4.5 L5.25,4.5 C4.28350169,4.5 3.5,5.28350169 3.5,6.25 L3.5,14.75 C3.5,15.7164983 4.28350169,16.5 5.25,16.5 L7.49878573,16.5 L7.49899997,17.2497857 L7.49985739,20.2505702 L12.5135149,16.5 Z"
                                                            id="🎨-Color">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                            {{ $item->reviews->count() }}
                                        </div>
                                        <div style="margin-left: 5px">
                                            <svg fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42 42"
                                                enable-background="new 0 0 42 42" xml:space="preserve">
                                                <path
                                                    d="M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
                                                                                    C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
                                                                                    C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z" />
                                            </svg>
                                            {{ $item->views }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="main-content__box">
                <h4>{{ __('High View Posts') }}</h4>
                <div class="main-content__list-item">
                    @foreach ($interactionsPosts as $item)
                        <a href="{{ route('detail', ['id' => $item->id]) }}" class="main-content__item">
                            <div class="w-100 h-100 main-container__item">
                                <div class="info-post-item d-flex">
                                    <img src="{{ asset(!empty($item->user->avatar) ? $item->user->avatar : 'images/avatar_default.png') }}"
                                        title="Avatar của {{ $item->user->name }}" alt="">
                                    <div>
                                        <h5 class="info-post-verify">
                                            {{ $item->user->name }}
                                            @if ($item->user->verify)
                                                <svg viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z"
                                                        fill="#1d9bf0"></path>
                                                </svg>
                                            @endif
                                        </h5>
                                        @if ($item->verify)
                                            <span class="verifyText">{{ __('This post had been verified') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <h5 class="ml-2">{{ $item->title }}</h5>
                                <div class="d-flex justify-content-between">
                                    <span class="item-footer">{{ formatDate($item->created_at) }}</span>
                                    <div class="d-flex item-footer">
                                        <div style="margin-right: 5px">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                                <title>ic_fluent_comment_24_regular</title>
                                                <desc>Created with Sketch.</desc>
                                                <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="ic_fluent_comment_24_regular" fill="#212121"
                                                        fill-rule="nonzero">
                                                        <path
                                                            d="M5.25,18 C3.45507456,18 2,16.5449254 2,14.75 L2,6.25 C2,4.45507456 3.45507456,3 5.25,3 L18.75,3 C20.5449254,3 22,4.45507456 22,6.25 L22,14.75 C22,16.5449254 20.5449254,18 18.75,18 L13.0124851,18 L7.99868152,21.7506795 C7.44585139,22.1641649 6.66249789,22.0512036 6.2490125,21.4983735 C6.08735764,21.2822409 6,21.0195912 6,20.7499063 L5.99921427,18 L5.25,18 Z M12.5135149,16.5 L18.75,16.5 C19.7164983,16.5 20.5,15.7164983 20.5,14.75 L20.5,6.25 C20.5,5.28350169 19.7164983,4.5 18.75,4.5 L5.25,4.5 C4.28350169,4.5 3.5,5.28350169 3.5,6.25 L3.5,14.75 C3.5,15.7164983 4.28350169,16.5 5.25,16.5 L7.49878573,16.5 L7.49899997,17.2497857 L7.49985739,20.2505702 L12.5135149,16.5 Z"
                                                            id="🎨-Color">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                            {{ $item->reviews->count() }}
                                        </div>
                                        <div style="margin-left: 5px">
                                            <svg fill="#000000" height="800px" width="800px" version="1.1"
                                                id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42 42"
                                                enable-background="new 0 0 42 42" xml:space="preserve">
                                                <path
                                                    d="M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
                                                                                    C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
                                                                                    C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z" />
                                            </svg>
                                            {{ $item->views }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
