@extends('layout')
@section('content')
    <h1>Category: {{ $category->name }}</h1>
    <!-- end carousel -->
    <!-- library welcome cats -->
    <div class="container mt-5">
        <div class="row">
            @php
                function truncate_words($string, $length, $dots = '...')
                {
                    if (strlen($string) > $length) {
                        // Find the last space before the length limit
                        $string = substr($string, 0, $length);
                        $string = substr($string, 0, strrpos($string, ' '));
                        return $string . $dots;
                    }
                    return $string;
                }
            @endphp
            @foreach ($category->books as $book)
                <div class="col mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset($book->image_url) != env('APP_URL') . '/' ? asset($book->image_url) : asset('asset/images/book1.avif') }}"
                            class="card-img-top" alt="{{ asset('asset/images/book1.avif') }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ truncate_words($book->description, 40) }}</p>
                            <button class="btn btn-primary get-book-api" data-id="{{ $book->id }}">Get Book
                                Info</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!-- end library welcome cats -->
    <div id="book-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Book Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>book description</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('button.get-book-api');
                const modal = document.getElementById('book-modal');
                const modalTitle = modal.querySelector('.modal-title');
                const modalBody = modal.querySelector('.modal-body p');

                buttons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        const bookId = this.getAttribute('data-id');

                        fetch("/api/book-info/" + bookId, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                modalTitle.textContent = data.title;
                                modalBody.textContent = data.description;
                                if (window.bootstrap && typeof window.bootstrap.Modal === 'function') {
                                    var bsModal = new bootstrap.Modal(modal);
                                    bsModal.show();
                                } else if (window.jQuery && window.jQuery.fn && typeof window.jQuery.fn.modal === 'function') {
                                    window.jQuery(modal).modal('show');
                                }
                                console.log(data);
                            })
                            .catch(error => console.error('Error fetching book data:', error));
                    });
                });
            });



            // document.addEventListener('DOMContentLoaded', function() {
            //     const buttons = document.querySelectorAll('a.btn.btn-primary');
            //     const modal = document.getElementById('book-modal');
            //     const modalTitle = modal.querySelector('.modal-title');
            //     const modalBody = modal.querySelector('.modal-body p');

            //     buttons.forEach(button => {
            //         button.addEventListener('click', function(event) {
            //             event.preventDefault();
            //             const bookId = this.getAttribute('data-id');

            //             fetch(`/api/book/${bookId}`)
            //                 .then(response => response.json())
            //                 .then(data => {
            //                     modalTitle.textContent = data.title;
            //                     modalBody.textContent = data.description;
            //                     $(modal).modal('show');
            //                 })
            //                 .catch(error => console.error('Error fetching book data:', error));
            //         });
            //     });
            // });
        </script>
    @endscript
@endsection
