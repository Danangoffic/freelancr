@extends('layouts.app')
@section('title', 'Add Service')
@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Add Your Service
                    </h2>
                    <p class="text-sm text-gray-400">
                        Upload the services you provide
                    </p>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="{{ route('member.service.index') }}" class="text-gray-400">My Services</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('member.service.create') }}" class="font-medium">Add Your Service</a>
                </li>
            </ol>
        </nav>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        <form action="{{ route('member.service.store') }}" id="form-create-service" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label for="title" class="block mb-3 font-medium text-gray-700 text-md">{{__('Judul Service')}}</label>
                                            <input placeholder="Service apa yang ingin kamu tawarkan?" type="text"
                                                required name="title" id="title" autocomplete="title"
                                                value="{{ old('title') }}"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('title')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="description"
                                                class="block mb-3 font-medium text-gray-700 text-md">{{__('Deskripsi Service')}}</label>
                                            <input placeholder="Jelaskan Service apa yang kamu tawarkan?" type="text" value="{{old('description')}}"
                                                required name="description" id="description" autocomplete="description"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('description')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="advantage-1"
                                                class="block mb-2 font-medium text-gray-700 text-md">{{__('Keunggulan Service kamu')}}</label>
                                            <p class="block mb-3 text-sm text-gray-700">
                                                Hal apa aja yang didapakan dari service kamu?
                                            </p>
                                            <input placeholder="Keunggulan service kamu ke-1" type="text" name="advantage-service[]" value="{{old('advantage-service[]')}}"
                                                id="advantage-1" autocomplete="advantage-1"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('advantage-service[]')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                            <input placeholder="Keunggulan service kamu ke-2" type="text" name="advantage-service[]" value="{{old('advantage-service[]')}}"
                                                id="advantage-2" autocomplete="advantage-2"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('advantage-service[]')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                            <input placeholder="Keunggulan service kamu ke-3" type="text" name="advantage-service[]" value="{{old('advantage-service[]')}}"
                                                id="advantage-3" autocomplete="advantage-3"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('advantage-service[]')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                            <div id="newServicesRow"></div>
                                            <button type="button"
                                                class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                id="addServicesRow">
                                                Tambahkan Keunggulan +
                                            </button>
                                        </div>
                                        <div class="col-span-6 -mb-6">
                                            <label for="delivery_time"
                                                class="block mb-3 font-medium text-gray-700 text-md">Estimasi Service & Jumlah Revisi</label>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <select id="delivery_time" name="delivery_time" autocomplete="delivery_time" required
                                                class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option selected disabled>Butuh Berapa Lama Service Kamu Selesai?</option>
                                                <option value="2">2 Hari</option>
                                                <option value="4">4 Hari</option>
                                                <option value="8">8 Hari</option>
                                                <option value="16">16 Hari</option>
                                                <option value="32">32 Hari</option>
                                                <option value="60">60 Hari</option>
                                            </select>
                                            @error('delivery_time')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <select id="revision_limit" name="revision_limit" autocomplete="revision_limit" required
                                                class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option selected disabled>Maksimal revisi service kamu?</option>
                                                <option value="2">2 Revisi</option>
                                                <option value="5">5 Revisi</option>
                                                <option value="7">7 Revisi</option>
                                                <option value="10">10 Revisi</option>
                                                <option value="11">11 Revisi</option>
                                            </select>
                                            @error('revision_limit')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="price"
                                                class="block mb-3 font-medium text-gray-700 text-md">{{__('Harga Service Kamu')}}
                                            </label>
                                            <input placeholder="Total Harga Service Kamu" type="number" name="price" required
                                                id="price" autocomplete="price"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('price')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="thumbnails"
                                                class="block mb-3 font-medium text-gray-700 text-md">{{__('Thumbnail Service Feeds')}}</label>
                                            <div class="my-4">
                                                <label for="thumbnails-1"
                                                    class="w-full cursor-pointer px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 focus:border-green-500">
                                                    Choose File
                                                </label>
                                                <input placeholder="thumbnail 1" type="file" name="thumbnails[]"
                                                    hidden id="thumbnails-1" autocomplete="thumbnails-1"
                                                    class="hidden w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('thumbnails[]')
                                                    <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="my-4">
                                                <label for="thumbnails-2"
                                                    class="w-full cursor-pointer px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 focus:border-green-500">
                                                    Choose File
                                                </label>
                                                <input placeholder="thumbnail 2" type="file" name="thumbnails[]"
                                                    hidden id="thumbnails-1" autocomplete="thumbnails-1"
                                                    class="hidden w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('thumbnails[]')
                                                    <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="my-4">
                                                <label for="thumbnails-3"
                                                    class="w-full cursor-pointer px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 focus:border-green-500">
                                                    Choose File
                                                </label>
                                                <input placeholder="thumbnail 3" type="file" name="thumbnails[]"
                                                    hidden id="thumbnails-2" autocomplete="thumbnails-2"
                                                    class="hidden w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('thumbnails[]')
                                                    <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div id="newThumbnailRow"></div>
                                            <button type="button"
                                                class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                id="addThumbnailRow">
                                                Tambahkan Gambar +
                                            </button>
                                            @error('thumbnails')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="user-advantages"
                                                class="block mb-3 font-medium text-gray-700 text-md">Keunggulan
                                                kamu</label>
                                            <input placeholder="Keunggulan 1" type="text" name="user_advantages[]" value="{{old('user_advantages[]')}}"
                                                id="user-advantages-1" autocomplete="user-advantages-1"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('user_advantages[]')
                                                    <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                            <input placeholder="Keunggulan 2" type="text" name="user_advantages[]" value="{{old('user_advantages[]')}}"
                                                id="user-advantages-2" autocomplete="user-advantages-2"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('user_advantages[]')
                                                    <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                            <input placeholder="Keunggulan 3" type="text" name="user_advantages[]" value="{{old('user_advantages[]')}}"
                                                id="user-advantages-3" autocomplete="user-advantages-3"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('user_advantages[]')
                                                    <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                            <div id="newAdvantagesRow"></div>
                                            <button type="button"
                                                class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                id="addAdvantagesRow">
                                                Tambahkan Keunggulan +
                                            </button>
                                            @error('user_advantages')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="note"
                                                class="block mb-3 font-medium text-gray-700 text-md">Note <span
                                                    class="text-gray-400">(Optional)</span></label>
                                            <input placeholder="Hal yang ingin disampaikan oleh kamu?" type="text"
                                                name="note" id="note" autocomplete="note"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('note')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label for="tags"
                                                class="block mb-3 font-medium text-gray-700 text-md">
                                                Tagline <span lass="text-gray-400">(Optional)</span>
                                            </label>
                                            <div id="newTaglineRow"></div>
                                            <button type="button"
                                                class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                id="addTaglineRow">
                                                Tambahkan Tagline +
                                            </button>
                                            @error('tagline[]')
                                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href="{{ route('member.service.index') }}"
                                        onclick="return confirmCancel()"
                                        class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                                        Cancel
                                    </a>
                                    <button type="submit" onclick="confirmSubmit()"
                                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Create Service
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
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/nwfvbj3fnzl41p0eiwunp60lbvq6ishh7unpivnivrv764tq/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: '#description'
      });

    var thumbnails, nextThumbnails,
        keunggulanServices, nextKeunggulanServices,
        keunggulanMember, nextKeunggulanMember,
        tagline, nextTagline;
        // add row advnatage users
        $("#addAdvantagesRow").click(function() {
            var html = '';
            html +=
                `<input placeholder="Keunggulan Kamu" type="text" name="user_advantages[]" id="user-${nextKeunggulanMember}" autocomplete="user-${nextKeunggulanMember}"
                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">`;
            $('#newAdvantagesRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeAdvantagesRow', function() {
            $(this).closest('#inputFormAdvantagesRow').remove();
        });

        getThumbnailsNode();
        // add row advantage service
        const addServicesRow = () => {
            var html =
                `<input placeholder="Keunggulan Service ke ${nextKeunggulanServices}" type="text" name="advantage-service[]" id="advantage-service-${nextKeunggulanServices}" autocomplete="advantage-service-${nextKeunggulanServices}"
                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">`;
            $('#newServicesRow').append(html);
        };
        $("#addServicesRow").click(addServicesRow);

        // remove row
        $(document).on('click', '#removeServicesRow', function() {
            $(this).closest('#inputFormServicesRow').remove();
        });
        // add row tagline
        $("#addTaglineRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Keunggulan" type="text" name="tagline[]" id="tagline" autocomplete="tagline" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">';
            $('#newTaglineRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeTaglineRow', function() {
            $(this).closest('#inputFormTaglineRow').remove();
        });
        // add row
        $("#addThumbnailRow").click(function() {
            var html = '';
            html +=
                `
                <div class="my-4">
                    <label for="thumbnails-${nextThumbnails}"
                    class="w-full cursor-pointer px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 focus:border-green-500">
                    Choose File
                </label>
                <input placeholder="Thumbnail ${nextThumbnails}" hidden type="file" name="thumbnails[]" id="thumbnails-${nextThumbnails}" autocomplete="" class="hiddne w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>
                `;

            $('#newThumbnailRow').append(html);
            getThumbnailsNode();
        });

        // remove row
        $(document).on('click', '#removeThumbnailRow', function() {
            $(this).closest('#inputFormThumbnailRow').remove();
        });

        function getThumbnailsNode() {
            thumbnails = document.querySelectorAll("input[name='thumbnails[]']");
            nextThumbnails = thumbnails.length + 1;
        }

        function getKeunggulanServiceNode() {
            keunggulanServices = document.querySelectorAll("input[name='advantages[]']");
            nextKeunggulanServices = keunggulanServices.length + 1;
        }

        function getKeunggulanMemberNode() {
            keunggulanMember = document.querySelectorAll("input[name='user_advantages[]']");
            nextKeunggulanMember = keunggulanMember.length + 1;
        }

        function getTaglineNode() {
            tagline = document.querySelectorAll("input[name='tagline[]']");
            nextTagline = tagline.length + 1;
        }

        function confirmCancel() {
            event.preventDefault();
            return getConfirmCall("Are you sure want to cancel?").then(result => {
                if(result.isConfirmed){
                    window.location.href="{{route('member.service.index')}}";
                }
            });
        }

        function confirmSubmit() {
            event.preventDefault();
            return getConfirmCall("Are you sure want to submit this data?").then(result => {
                if(result.isConfirmed){
                    document.querySelector("form#form-create-service").submit();
                }
            });
        }
    </script>
@endpush
