@extends('layouts.dashboard')

@section('title', 'Add User:Larapets🐶')

@section('content')
    <h1 class="text-4xl text-black flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-5 mt-15">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000" viewBox="0 0 256 256">
            <path
                d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
        </svg>
        Add User
    </h1>

    <div class="breadcrumbs text-sm">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4 w-4 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4 w-4 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    User Module
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4 w-4 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Add User
                </span>
            </li>
        </ul>
    </div>

    <section
        class="bg-[#0004] text-white rounded-lg md:w-[720px] w-[360px] p-8 flex flex-col gap-4 items-center justify-center">

        <div class="card w-full ">
            <form method="POST" action="{{ URL('users') }}" class="flex flex-col gap-4 card-body" enctype="multipart/form-data">
                @csrf

                <!-- Dos columnas -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-1/2">
                        <div
                            class="avatar flex flex-col items-center justify-center gap-2 cursor-pointer hover:scale-110 transition ease-in">
                            <div id="upload" class="mask mask-squircle w-48">
                                <img id="preview" src="{{asset('images/no-photo.png')}}" />
                            </div>
                            <small class="pb-0 border-white border-b flex gap-1 items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#fff"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M208,40H48A24,24,0,0,0,24,64V176a24,24,0,0,0,24,24H208a24,24,0,0,0,24-24V64A24,24,0,0,0,208,40Zm8,136a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8H208a8,8,0,0,1,8,8Zm-48,48a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,224ZM157.66,106.34a8,8,0,0,1-11.32,11.32L136,107.31V152a8,8,0,0,1-16,0V107.31l-10.34,10.35a8,8,0,0,1-11.32-11.32l24-24a8,8,0,0,1,11.32,0Z">
                                    </path>
                                </svg>
                                Upload Photo
                            </small>
                            @error('photo')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror
                        </div>
                        <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                    </div>
                    <div class="w-full md:w-1/2">
                        {{-- Document --}}
                        <label class="label">Document</label>
                        <input type="text" class="input bg-[#0006] w-full mt-1 outline-0" name="document"
                            placeholder="753921345" value="{{ old('document') }}" />
                        @error('document')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror

                        {{-- FullName --}}
                        <label class="label">FullName</label>
                        <input type="text" class="input bg-[#0006] w-full mt-1 outline-0" name="fullname"
                            placeholder="John Doe" value="{{ old('fullname') }}" />
                        @error('fullname')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror

                        {{-- Gender --}}
                        <label class="label">Gender</label>
                        <select name="gender" class="select bg-[#0009] w-full outline-0">
                            <option value="">Select...</option>
                            <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                            <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                        </select>
                        @error('gender')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror

                        {{-- Birthdate --}}
                        <label class="label">Birthdate</label>
                        <input type="date" class="input bg-[#0006] w-full mt-1 outline-0" name="birthdate"
                            placeholder="1999-10-29" value="{{ old('birthdate') }}" />
                        @error('birthdate')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/2">
                        {{-- Phone --}}
                        <label class="label">Phone</label>
                        <input type="text" class="input bg-[#0006] w-full mt-1 outline-0" name="phone"
                            placeholder="123-456-7890" value="{{ old('phone') }}" />
                        @error('phone')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror

                        {{-- Email --}}
                        <label class="label">Email</label>
                        <input type="text" name="email" class="input bg-[#0006] w-full outline-0" required
                            placeholder="Email" value="{{ old('email') }}" />
                        @error('email')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror

                        {{-- Password --}}
                        <label class="label">Password</label>
                        <input type="password" class="input bg-[#0006] w-full outline-0" name="password"
                            placeholder="Password" />
                        @error('password')
                            <small class="badge badge-error w-full mt-1 py-4">{{ $message }}</small>
                        @enderror

                        {{-- Confirm Password --}}
                        <label class="label">Confirm Password</label>
                        <input type="password" class="input bg-[#0006] w-full outline-0" name="password_confirmation"
                            placeholder="Password" />
                    </div>
                </div>

                <!-- Botón debajo de las dos columnas -->
                <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-4">Add</button>

            </form>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#upload').click(function (e) {
                e.preventDefault()
                $('#photo').click()
            })
            $('#photo').change(function (e){
                e.preventDefault()
                $('#preview').attr('src', window.URL.createObjectURL($(this).prop('files')[0]))
            })
        })
    </script>

@endsection