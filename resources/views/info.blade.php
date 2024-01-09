@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/follow.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/modalReport.js') }}" defer></script>
    <script src="{{ asset('js/info.js') }}" defer></script>
    <script src="{{ asset('js/follow.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="main-content__box">
            <div class="row js-parent">
                <div class="col-md-6">
                    <div class="info-post-item d-flex">
                        <img src="{{ asset(!empty($userInfo->avatar) ? $userInfo->avatar : 'images/avatar_default.png') }}"
                            title="Avatar của {{ $userInfo->name }}" alt="">
                        <div class="">
                            <h5 class="info-post-verify">
                                {{ $userInfo->name }}
                                @if ($userInfo->verify)
                                    <svg viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z"
                                            fill="#1d9bf0"></path>
                                    </svg>
                                @endif
                            </h5>
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="d-flex item-footer mt-2">
                                    <span class="item-footer"
                                        style="margin-right: 20px">{{ formatDate($userInfo->created_at) }}</span>
                                    <div style="margin-right: 5px">
                                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17,11H16a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm0,4H16a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2ZM11,9h6a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2ZM21,3H7A1,1,0,0,0,6,4V7H3A1,1,0,0,0,2,8V18a3,3,0,0,0,3,3H18a4,4,0,0,0,4-4V4A1,1,0,0,0,21,3ZM6,18a1,1,0,0,1-2,0V9H6Zm14-1a2,2,0,0,1-2,2H7.82A3,3,0,0,0,8,18V5H20Zm-9-4h1a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2Zm0,4h1a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2Z" />
                                        </svg>
                                        {{ $countPosts }}
                                    </div>
                                    <div style="margin-right: 5px">
                                        <svg fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 42 42" enable-background="new 0 0 42 42" xml:space="preserve">
                                            <path
                                                d="M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
                                                                C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
                                                                C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z">
                                            </path>
                                        </svg>
                                        {{ $countViews }}
                                    </div>
                                    @if (!empty(Auth::user()) && in_array(Auth::user()->role->slug, config('constants.modSlug')))
                                        <div style="margin-right: 5px">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4 9V3H12.0284L10.0931 5.70938C9.96896 5.88323 9.96896 6.11677 10.0931 6.29062L12.0284 9H4ZM4 10H13C13.4067 10 13.6432 9.54032 13.4069 9.20938L11.1145 6L13.4069 2.79062C13.6432 2.45968 13.4067 2 13 2H3.5C3.22386 2 3 2.22386 3 2.5V13.5C3 13.7761 3.22386 14 3.5 14C3.77614 14 4 13.7761 4 13.5V10Z"
                                                    fill="#9F9F9F"></path>
                                            </svg>
                                            {{ $countReports }}
                                        </div>
                                    @endif
                                    <div>
                                        <svg class="svg-icon"
                                            style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M862.3616 605.44c-44.1344 0.4608-74.752 21.7088-94.2592 45.7216-19.1488-24.32-49.8176-45.7216-95.0784-45.7216-29.9008 0-54.7328 9.6768-73.7792 28.8256-34.8672 35.0208-35.584 87.7568-35.2256 89.3952-0.8704 5.3248-18.8928 131.9936 192.768 237.4656 3.584 1.792 7.5264 2.7136 11.4176 2.7136 4.1472 0 8.2432-1.024 11.9808-3.0208 128-67.9424 194.56-150.2208 192.512-239.8208C972.7488 674.56 943.7184 605.44 862.3616 605.44zM767.8464 909.312c-162.816-85.4528-153.7024-174.08-152.9344-181.6064-0.0512-9.4208 3.6352-40.192 20.6848-57.2928 9.216-9.2672 21.4528-13.7728 37.4784-13.7728 54.2208 0 68.1472 49.5104 69.4784 54.9888 2.6624 11.3664 12.6976 19.4048 24.3712 19.6608 11.2128-1.2288 22.0672-7.4752 25.2416-18.688 0.6656-2.2528 16.3328-55.3984 71.6288-55.9616 57.1392 0 57.7536 61.7472 57.8048 67.3792C923.0336 787.7632 868.5568 853.248 767.8464 909.312zM768.0512 321.4848c0-155.2384-126.3104-281.6-281.6-281.6s-281.6 126.3104-281.6 281.6c0 109.6192 63.0784 204.5952 154.7264 251.0848-168.8576 54.1184-308.3264 207.4624-308.3264 363.3152 0 14.1312 11.4688 25.6 25.6 25.6s25.6-11.4688 25.6-25.6c0-164.864 193.792-332.8 384-332.8C641.6896 603.0848 768.0512 476.7744 768.0512 321.4848zM486.4512 551.8848c-127.0272 0-230.4-103.3728-230.4-230.4 0-127.0272 103.3728-230.4 230.4-230.4s230.4 103.3728 230.4 230.4C716.8512 448.512 613.4784 551.8848 486.4512 551.8848z">
                                            </path>
                                        </svg>
                                        {{ $countFollows }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-detail col-md-6 d-flex align-items-center justify-content-end">
                    <a class="btn btn-danger js-report" data-toggle="modal"
                        data-type="{{ config('constants.user.userType') }}" data-target="#reportModal"
                        data-id="{{ $userId }}">
                        <h6 class="m-0">{{ __('Report') }}</h6>
                    </a>
                    <a class="btn btn-success">
                        <h6 class="m-0">{{ __('Follow') }}</h6>
                    </a>
                </div>
            </div>
            <ul class="nav nav-pills nav-justified position-relative mt-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#follows" data-toggle="tab">
                        {{ __('Follows') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#posts" data-toggle="tab">
                        {{ __('Posts') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="ex2-content">
                <div class="tab-pane fade show active" id="follows" role="tabpanel" aria-labelledby="ex3-tab-1">
                    @include('components.pages.follow.containerFollows')
                </div>
                <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="ex3-tab-2">
                    @include('components.pages.posts.containerPosts')
                </div>
            </div>
        </div>
    </div>
    @include('components.pages.main.modalReport')
@endsection
