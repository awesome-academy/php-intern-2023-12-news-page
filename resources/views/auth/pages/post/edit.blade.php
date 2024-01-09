@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create_post.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="{{ asset('js/create_post.js') }}" defer></script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <div style="padding: 7rem 0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="p-6 bg-white border-b border-gray-200 w-full rounded-md">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('posts.update', ['post' => $data->id]) }}" method="post"
                    class="position-relative" id="posts" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('Category') }}: </label>
                        <select class="form-control" name='category'>
                            <option value="">-- {{ __('Pick one') . ' ' . __('category') }} --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $data->category_id === $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="thumbnail">{{ __('Thumbnail') }}: </label>
                        <div class="upload-container relative flex items-center justify-between w-full">
                            <div
                                class="drop-area w-full rounded-md border-2 border-dotted border-gray-200 transition-all hover:border-blue-600/30 text-center">
                                <label style="font-size: 14px;" for="file-input"
                                    class="block w-full h-full text-gray-500 p-4 text-sm cursor-pointer">
                                    {{ __('Drop file or click to choose') }}
                                </label>
                                <input name="file" type="file" id="file-input" accept="image/*" class="hidden"
                                    value="{{ $data->thumbnail }}" />
                                <!-- Image upload input -->
                                <div class="preview-container flex items-center justify-center flex-col">
                                    <div class="preview-image w-36 h-36 bg-cover bg-center rounded-md"
                                        style="background-image: url('{{ asset($data->thumbnail) }}');"></div>
                                    <span class="file-name my-4 text-sm font-medium"></span>
                                    <p
                                        class="close-button cursor-pointer transition-all mb-4 rounded-md px-3 py-1 border text-xs text-red-500 border-red-500 hover:bg-red-500 hover:text-white">
                                        {{ __('Delete') }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="title">{{ __('Title') }}: </label>
                        <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="description">{{ __('Description') }}: </label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $data->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="content">{{ __('Content') }}: </label>
                        <textarea name="content" id="content" cols="30" rows="10">{!! $data->content !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="hashtag">{{ __('Hashtag') }}:
                            ({{ __('Press Back Until Empty Input To Remove Box Tag Or Click Outside The Search Block') }}
                            )</label>
                        <input type="text" class="form-control" name="hashtag" value="{{ $data->hashtags }}"
                            data-type = "edit">
                        <ul id="tagList">
                        </ul>
                        <div class="position-relative">
                            <input type="text" class="form-control" id="newTag">
                            <button data-toast="{{ __('The tag already exists in the list.') }}"
                                class="btn btn-success btn-add-tag position-absolute h-100 top-0 right-0 js-add-tag">
                                <input type="text" class="d-none" name="newHashtag">
                                <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.402 45.402"
                                    xml:space="preserve" stroke="#fff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <ul class="hashtag-result">
                            @foreach ($hashtags as $hashtag)
                                <li data-slug="{{ $hashtag->slug }}" data-id="{{ $hashtag->id }}">
                                    {{ $hashtag->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a class="btn btn-lg btn-danger mt-4" href="{{ route('posts.index') }}">{{ __('Back') }}</a>
                    <button type="submit" class="btn btn-lg btn-primary mt-4">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
