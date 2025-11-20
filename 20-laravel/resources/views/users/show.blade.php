@extends('layouts.dashboard')

@section('title', 'Show User: Larapets🐶')

@section('content')

    <h1 class="text-4xl text-black flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-5 mt-15">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000" viewBox="0 0 256 256">
            <path
                d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
        </svg>
        Show User
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

    {{-- Card --}}
    <div class="bg-[#0009] p-10 rounded-sm">
        <div class="avatar flex flex-col items-center justify-center gap-2 cursor-pointer hover:scale-110 transition ease-in">
            <div class="mask mask-squircle w-60">
                <img src="{{asset('images/' .$user->photo)}}" />
            </div>
        </div>
        {{-- data --}}
        <div class="flex gap-2">
            <ul class="list bg-[#0009] text-white mt-4 rounded-box shadow-md">
                <li class="list-row">
                    <span class="text-[#fff9]">Document: <span>{{ $user->document }}</span></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">FullName: <span>{{ $user->fullname }}</span></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Gender: <span>{{ $user->gender }}</span></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Birthdate: <span>{{ $user->birthdate }}</span></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Phone: <span>{{ $user->phone }}</span></span>
                </li>
            </ul>
            <ul class="list bg-[#0009] text-white mt-4 rounded-box shadow-md">
                <li class="list-row">
                    <span class="text-[#fff9]">Email: <span>{{ $user->email }}</span></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Active: <td>
                            @if ($user->Active == 1)
                                <div class="badge badge-soft badge-accent">Active</div>
                            @else
                                <div class="badge badge-soft badge-secondary">Inactive</div>
                            @endif
                        </td></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Role: <td class="hidden md:table-cell">
                            @if ($user->role == 'Administrator')
                                <div class="badge badge-soft badge-warning">Admin</div>
                            @else
                                <div class="badge badge-soft badge-default">Customer</div>
                            @endif
                        </td></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Create At: <span>{{ $user->created_at }}</span></span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9]">Update At: <span>{{ $user->updated_at }}</span></span>
                </li>
            </ul>
        </div>
    </div>
@endsection