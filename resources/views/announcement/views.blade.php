@extends('layouts.master')

@section('title')
    Announcements
@endsection

@section('page-title')
    Announcements
@endsection

@section('body')
    <style>
        .form-control {
            background-color: #fff;
            color: #000;
        }
        .service-container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .task-container {
            margin-top: 10px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <body data-sidebar="colored">
    @endsection

    @section('content')
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f4f8;
                margin: 0;
                padding: 0;
            }
            header {
                text-align: center;
                margin-bottom: 20px;
            }
            header h1 {
                color: #14213d;
                font-size: 2em;
                margin: 0;
            }
            .search-container {
                margin-bottom: 20px;
                text-align: center;
            }
            .search-container input {
                width: 100%;
                max-width: 500px;
                padding: 10px;
                font-size: 1em;
                border: 2px solid #14213d;
                border-radius: 4px;
                outline: none;
                transition: border-color 0.3s;
            }
            .search-container input:focus {
                border-color: #0a1c2c;
            }
            .announcements-list {
                margin-top: 20px;
            }
            .announcement-item {
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 15px;
                background-color: #f9f9f9;
                transition: background-color 0.3s;
            }
            .announcement-item:hover {
                background-color: #eaf1f8;
            }
            .announcement-date {
                font-size: 0.9em;
                color: #888;
            }
            .announcement-title {
                font-size: 1.4em;
                font-weight: bold;
                color: #14213d;
                margin-top: 5px;
            }
            .announcement-body {
                margin-top: 10px;
                color: #333;
            }
            .announcement-body .more {
                display: none;
            }
            .announcement-body.expanded .more {
                display: block;
            }
            .announcement-body.collapsed .more {
                display: none;
            }
            .read-more-button {
                background-color: #14213d;
                color: #fff;
                border: none;
                padding: 10px;
                margin-top: 10px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1em;
                transition: background-color 0.3s;
            }
            .read-more-button:hover {
                background-color: #0a1c2c;
            }
            .pagination {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }
            .pagination button {
                background-color: #14213d;
                color: #fff;
                border: none;
                padding: 10px 15px;
                margin: 0 5px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1em;
                transition: background-color 0.3s;
            }
            .pagination button:hover {
                background-color: #0a1c2c;
            }
            .pagination button.disabled {
                background-color: #ddd;
                cursor: not-allowed;
            }
        </style>

        <div class="row">
            <div class="col-12">
                <div class="card bg-white p-3">
                    <div class="container">
                        <header>
                            <h1>Announcements</h1>
                        </header>

                        <div class="search-container">
                            <input type="text" id="searchInput" placeholder="Search announcements..." onkeyup="filterAnnouncements()">
                        </div>

                        <div class="announcements-list" id="announcementsList">
                            @foreach ($announcements as $announcement)
                                <div class="announcement-item">
                                    <div class="announcement-date">{{ \Carbon\Carbon::parse($announcement->date)->format('d F Y') }}</div>
                                    <div class="announcement-title">{{ $announcement->title }}</div>
                                    <div class="announcement-body collapsed">
                                        {{-- {!! $announcement->description !!} --}}
                                        <a href="/view-announcement/{{$announcement->file_id}}" class="read-more-button" >Read More</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination" id="paginationControls">
                            <!-- Pagination buttons will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <script>
            const announcements = @json($announcements);
            const itemsPerPage = 5;
            let currentPage = 1;

            function renderAnnouncements(page) {
                const list = document.getElementById('announcementsList');
                list.innerHTML = '';

                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, announcements.length);

                for (let i = startIndex; i < endIndex; i++) {
                    const announcement = announcements[i];
                    list.innerHTML += `
                        <div class="announcement-item">
                            <div class="announcement-date">${announcement.date}</div>
                            <div class="announcement-title">${announcement.title}</div>
                            <div class="announcement-body collapsed">

                                <a href="/view-announcement/${announcement.file_id}" class="read-more-button" >Read More</a>
                            </div>
                        </div>
                    `;

                    // ${announcement.description}
                }
            }

            function renderPagination() {
                const pagination = document.getElementById('paginationControls');
                pagination.innerHTML = '';

                const totalPages = Math.ceil(announcements.length / itemsPerPage);

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;
                    button.className = i === currentPage ? 'disabled' : '';
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderAnnouncements(currentPage);
                        renderPagination();
                    });
                    pagination.appendChild(button);
                }
            }

            function filterAnnouncements() {
                const input = document.getElementById('searchInput');
                const filter = input.value.toLowerCase();
                const items = document.getElementsByClassName('announcement-item');

                for (let i = 0; i < items.length; i++) {
                    const title = items[i].getElementsByClassName('announcement-title')[0];
                    if (title.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        items[i].style.display = "";
                    } else {
                        items[i].style.display = "none";
                    }
                }
            }

            function toggleReadMore(button) {
                const announcementBody = button.previousElementSibling;
                if (announcementBody.classList.contains('collapsed')) {
                    announcementBody.classList.remove('collapsed');
                    announcementBody.classList.add('expanded');
                    button.textContent = 'Read Less';
                } else {
                    announcementBody.classList.remove('expanded');
                    announcementBody.classList.add('collapsed');
                    button.textContent = 'Read More';
                }
            }

            renderAnnouncements(currentPage);
            renderPagination();
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection

    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
