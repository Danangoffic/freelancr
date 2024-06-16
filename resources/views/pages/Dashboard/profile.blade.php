@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit My Profile
                    </h2>
                    <p class="text-sm text-gray-400">
                        Enter your data Correctly & Properly
                    </p>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        <form action="{{ route('member.profile.update', Auth::user()->id) }}" id="form-profile-member"
                            method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <div class="flex items-center mt-1">
                                                @if (Auth::user()->detail_user->photo)
                                                    <img src="{{ url(Storage::url(Auth::user()->detail_user->photo)) }}"
                                                        alt="photo" class="rounded-full w-16 h-16">
                                                @else
                                                    <span
                                                        class="inline-block w-16 h-16 overflow-hidden bg-gray-100 rounded-full">
                                                        <svg class="w-full h-full text-gray-300" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </span>
                                                @endif
                                                <label for="choose"
                                                    class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    Choose File
                                                </label>
                                                <input type="file" name="photo" id="choose" accept="image/*" hidden>
                                                {{-- <button type="button"
                                                    class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    Choose File
                                                </button> --}}
                                                <a href="{{ route('member.delete.photo.profile') }}"
                                                    onclick="confirmDeletePhoto()"
                                                    class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-red-700 bg-transparent rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    Delete
                                                </a>
                                                @error('photo')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Full
                                                Name</label>
                                            <input placeholder="Your Name" type="text" name="name" required
                                                value="{{ $user->name ?? '' }}" id="name" autocomplete="name"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('name')
                                                <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="role"
                                                class="block mb-3 font-medium text-gray-700 text-md">Role</label>
                                            <input placeholder="Your Role" type="text" name="role" required
                                                value="{{ $user->detail_user->role ?? old('role') }}" id="role"
                                                autocomplete="role"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('role')
                                                <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="email" class="block mb-3 font-medium text-gray-700 text-md">Email
                                                Address</label>
                                            <input placeholder="Your Email" type="email" name="email" required
                                                value="{{ $user->email }}" id="email" autocomplete="email"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('email')
                                                <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="contact_number"
                                                class="block mb-3 font-medium text-gray-700 text-md">Contact Number</label>
                                            <input placeholder="Your contact number" type="number" name="contact_number"
                                                value="{{ $user->detail_user->contact_number ?? old('contact_number') }}"
                                                id="contact_number" autocomplete="contact_number"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('contact_number')
                                                <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="biography"
                                                class="block mb-3 font-medium text-gray-700 text-md">Biografi</label>
                                            <textarea placeholder="Your biography" type="text" name="biography" id="biography" autocomplete="biography"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                rows="4">{{ $user->detail_user->biography ?? old('biography') }}</textarea>
                                            @error('biography')
                                                <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="experience" class="block mb-3 font-medium text-gray-700 text-md">My
                                                Experience</label>
                                            @forelse ($experience_user as $key => $item)
                                                <input placeholder="More than 9 years of experience" type="text"
                                                    name="experience[{{ $item->id }}]"
                                                    id="experience[{{ $item->id }}]"
                                                    autocomplete="experience[{{ $item->id }}]"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm
                                                    focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    value="{{ $item->experience }}">
                                                @error('experience[' . $item->id . ']')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                                @enderror
                                            @empty
                                                <input
                                                    placeholder="Knowledge in the fields of interface design, marketing and etc"
                                                    type="text" name="experience[]" id="experience[]"
                                                    autocomplete="experience[]"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm
                                                    focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('experience')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                                @enderror
                                                <input
                                                    placeholder="Knowledge in the fields of interface design, marketing and etc"
                                                    type="text" name="experience[]" id="experience[]"
                                                    autocomplete="experience[]"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm
                                                    focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('experience')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                                @enderror
                                                <input
                                                    placeholder="Knowledge in the fields of interface design, marketing and etc"
                                                    type="text" name="experience[]" id="experience[]"
                                                    autocomplete="experience[]"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm
                                                    focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('experience')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                                @enderror
                                            @endforelse
                                            @if ($experience_user->count() > 0 && $experience_user->count() < 3)
                                                <?php $least = $experience_user->count() - 3; ?>
                                                @for ($i = 0; $i < $least; $i++)
                                                    <input
                                                        placeholder="Knowledge in the fields of interface design, marketing and etc"
                                                        type="text" name="experience[]" id="experience[]"
                                                        autocomplete="experience[]"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm
                                                        focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                    @error('experience')
                                                        <p class="text-red-500 mb-3 text-sm">{{ $message }}</p>
                                                    @enderror
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href="{{ route('member.dashboard.index') }}" type="button"
                                        class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                                        onclick="return confirm('Are you sure want to cancel? Any changes you`ve made will not be saved!)">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        id="submit-form">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection
@push('after-script')
    <script>
        const btnSubmit = document.querySelector("#submit-form"),
            formProfileMember = document.querySelector("form#form-profile-member");
        btnSubmit.addEventListener("click", confirmSubmitForm);

        function confirmSubmitForm() {
            event.preventDefault();
            getConfirmCall("Do you want to save the changes?").then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    formProfileMember.submit();
                }
            });
        }

        function confirmDeletePhoto() {
            event.preventDefault();
            const url  = "{{ route('member.delete.photo.profile') }}";
            const confirmCall = "Are you sure want to delete?";
            getConfirmCall(confirmCall).then(result => {
                if(result.isConfirmed){
                    window.location.href=url;
                }
            });
        }
    </script>
@endpush
