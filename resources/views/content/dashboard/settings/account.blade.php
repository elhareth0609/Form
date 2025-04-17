@extends('layouts.app')

@section('title', __('Account Settings'))

@section('content')


<style>
        .nav-tabs {
            border-bottom: none;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

        /* Center crop container and set circular shape */
        .crop-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%; /* Round the crop box */
        }

    </style>

        <div class="card p-4">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link active" href="{{ route('settings.account.get') }}"><span class="mdi mdi-cog-outline me-2"></span>{{ __('Edit Profile') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('settings.password.get') }}"><span class="mdi mdi-key-outline me-2"></span>{{ __('Password') }}</a></li>
            </ul>

            <form id="editProfileForm" action="{{ route('settings.account.update') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="mt-3 col-lg-3 col-md-12 text-center">
                        <div class="position-relative d-inline-block rounded-pill">
                            <img src="{{ Auth::user()->photoUrl }}" alt="Profile Picture" class="profile-pic border border-secondary p-1 rounded-pill" style="width: 200px;height: 200px;">
                            <a class="position-absolute bg-white px-2 rounded-pill border border-secondary d-flex align-items-center justify-content-center" aria-label="Edit Profile Picture" href="#" style="bottom: 18px;right: 10px;width: 30px;height: 30px;" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                                <i class="mdi mdi-pencil fs-5 text-secondary"></i>
                            </a>
                        </div>
                    </div>

                    <div class="mt-3 col-lg-9 col-md-12">
                        <div class="ms-4 row">
                            @if (Auth::user()->hasRole('admin'))
                                <div class="form-group form-group-floating col-md-6 mb-3">
                                    <input type="text" class="form-control" name="first_name" id="firstName" value="{{ Auth::user()->first_name }}">
                                    <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                                </div>
                                <div class="form-group form-group-floating col-md-6 mb-3">
                                    <input type="text" class="form-control" name="last_name" id="lastName" value="{{ Auth::user()->last_name }}">
                                    <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                                </div>
                            @else
                                <div class="form-group form-group-floating col-md-6 mb-3">
                                    <input type="text" class="form-control" id="firstName" name="first_name" value="{{ Auth::user()->full_name }}">
                                    <label for="firstName" class="form-label">{{ __('Name') }}</label>
                                </div>
                            @endif

                            <div class="form-group form-group-floating col-md-6 mb-3">
                                <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                            </div>
                            <div class="form-group form-group-floating col-md-6 mb-3">
                                <input type="phone" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}">
                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                            </div>
                            {{-- <div class="form-group form-group-floating col-md-6 mb-3">
                                <input type="text" class="form-control" id="role" value="{{ Auth::user()->role->name }}" disabled>
                                <label for="role" class="form-label">{{ __('Role') }}</label>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                </div>
            </form>
        </div>

<!-- Upload Image Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="uploadImageForm" method="POST" action="{{ route('settings.account.uploadImage') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageLabel">{{ __('Upload Image') }}</h5>
                    <button type="button" class="btn btn-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <input type="file" class="form-control" name="image" id="imageInput" accept="image/*" >
                    </div>
                    <div id="croppedImagePreview" class="mt-3 text-center"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" id="cropImageButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cropModal">{{ __('Next') }}</button>
                    <button type="submit" id="submitButton" class="btn btn-primary disabled">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Crop Image Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropLabel">{{ __('Crop Image') }}</h5>
                <button type="button" class="btn btn-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="crop-container w-100">
                    <img id="imageToCrop" src="" class="img-fluid">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" id="saveCroppedImage" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>






<script>
document.addEventListener('DOMContentLoaded', function () {
    let cropper;
    const imageInput = document.getElementById('imageInput');
    const imageToCrop = document.getElementById('imageToCrop');
    const saveCroppedImage = document.getElementById('saveCroppedImage');
    const croppedImagePreview = document.getElementById('croppedImagePreview');
    const uploadImageForm = $('#uploadImageForm');
    const submitButton = document.getElementById('submitButton');

    let croppedBlob = null;

    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            imageToCrop.src = '';
            const reader = new FileReader();
            reader.onload = function (e) {
                imageToCrop.src = e.target.result;
                new bootstrap.Modal(document.getElementById('cropModal')).show();

                imageToCrop.onload = function () {
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        minContainerWidth: 500,
                        minContainerHeight: 500,
                        cropBoxResizable: false,
                        cropBoxMovable: true,
                        background: false,
                        guides: false,
                    });
                };
            };
            reader.readAsDataURL(file);
        }
    });

    saveCroppedImage.addEventListener('click', function () {
        const canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500,
            imageSmoothingQuality: 'high'
        });

        const circularCanvas = document.createElement('canvas');
        circularCanvas.width = 500;
        circularCanvas.height = 500;
        const ctx = circularCanvas.getContext('2d');

        ctx.beginPath();
        ctx.arc(250, 250, 250, 0, 2 * Math.PI);
        ctx.clip();
        ctx.drawImage(canvas, 0, 0, 500, 500);

        circularCanvas.toBlob((blob) => {
            // Save the blob for submission
            croppedBlob = blob;

            // Display the cropped image as a preview below the file input
            const croppedImageURL = URL.createObjectURL(blob);
            croppedImagePreview.innerHTML = `<img src="${croppedImageURL}" alt="Cropped Image" class="img-thumbnail mt-2 rounded-pill" style="width: 150px; height: 150px;">`;

            // Hide the crop modal
            const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
            cropModal.hide();

            imageInput.value = ''; // Reset the file input
            submitButton.classList.remove('disabled'); // Enable the submit button
        });
    });

    // Handle the form submission with AJAX using jQuery
    uploadImageForm.on('submit', function (event) {
        event.preventDefault();

        if (!croppedBlob) {
            Swal.fire({
                icon: 'error',
                title: __("Error"),
                text: __("Please crop the image first!"),
                confirmButtonText: __("Ok")
            });
            return;
        }

        const formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());
        formData.append('image', croppedBlob, 'cropped-image.png');

        // Send AJAX request using jQuery
        $.ajax({
            url: uploadImageForm.attr('action'),
            method: uploadImageForm.attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });

                // Optionally reset the form and preview
                croppedImagePreview.innerHTML = '';
                croppedBlob = null;
                submitButton.classList.add('disabled');
            },
            error: function(xhr, textStatus, errorThrown) {
                const response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
            }
        });
    });
});

$(document).ready(function () {
    $('#editProfileForm').submit(function (event) {
        event.preventDefault();
        $('#loading').show();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#loading').hide();
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                $('#loading').hide();
                const response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
            }
        });
    });
});
</script>

@endsection
