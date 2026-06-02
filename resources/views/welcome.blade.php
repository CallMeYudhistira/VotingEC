<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voting's Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&display=swap');

        * {
            font-family: 'Baloo 2', Arial, Helvetica, sans-serif;
        }

        .hero {
            background: linear-gradient(to right, #0097b2, #00abc9);
            color: #fafafa;
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .row-table {
            border-top: 0.5px solid #ccc;
        }

        .row-table td,
        .row-table th {
            padding-top: 15px;
        }

        .card {
            margin: 0.7rem;
        }
    </style>
</head>

<body>
    <section class="hero">
        <div class="container">
            <h1>👑 Choose Your Leader! 👑</h1>
            <p>Your choice matters — pick the leader who will bring new energy and vision to the English Club.</p>
        </div>
    </section>
    <div class="container mt-5" style="align-items: center; justify-items: center; align-content: center;">
        <div class="row row-cols-1 row-cols-md-4 g-4" style="justify-content: space-between;">
            {{-- Fahri --}}
            <form action="/vote" method="post">
                @csrf
                <div class="col">
                    <div class="card" style="width: 280px;">
                        <img src="{{ asset('images/fahri.jpg') }}" class="card-img-top"
                            style="object-fit: cover; height: 300px;">
                        <table class="table p-2">
                            <tr class="row-table">
                                <th>Nama</th>
                                <td>:</td>
                                <td>Fahri</td>
                            </tr>
                            <tr class="row-table">
                                <th>Kelas</th>
                                <td>:</td>
                                <td>XI TKJ B</td>
                            </tr>
                        </table>
                        <div class="card-body">
                            <input type="hidden" name="nama_kandidat" value="fahri">
                            <button class="btn btn-success w-100" type="submit">Pilih</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Syafa --}}
            <form action="/vote" method="post">
                @csrf
                <div class="col">
                    <div class="card" style="width: 280px;">
                        <img src="{{ asset('images/syafa.jpg') }}" class="card-img-top"
                            style="object-fit: cover; height: 300px;">
                        <table class="table p-2">
                            <tr class="row-table">
                                <th>Nama</th>
                                <td>:</td>
                                <td>Syafa</td>
                            </tr>
                            <tr class="row-table">
                                <th>Kelas</th>
                                <td>:</td>
                                <td>XI RPL B</td>
                            </tr>
                        </table>
                        <div class="card-body">
                            <input type="hidden" name="nama_kandidat" value="syafa">
                            <button class="btn btn-success w-100" type="submit">Pilih</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Shasa --}}
            <form action="/vote" method="post">
                @csrf
                <div class="col">
                    <div class="card" style="width: 280px;">
                        <img src="{{ asset('images/shasa.jpg') }}" class="card-img-top"
                            style="object-fit: cover; height: 300px;">
                        <table class="table p-2">
                            <tr class="row-table">
                                <th>Nama</th>
                                <td>:</td>
                                <td>Shasa</td>
                            </tr>
                            <tr class="row-table">
                                <th>Kelas</th>
                                <td>:</td>
                                <td>XI RPL D</td>
                            </tr>
                        </table>
                        <div class="card-body">
                            <input type="hidden" name="nama_kandidat" value="shasa">
                            <button class="btn btn-success w-100" type="submit">Pilih</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Gibran --}}
            <form action="/vote" method="post">
                @csrf
                <div class="col">
                    <div class="card" style="width: 280px;">
                        <div style="background-image: url('{{ asset('images/bg.png') }}')">
                            <img src="{{ asset('images/gibran.png') }}" class="card-img-top"
                                style="object-fit: cover; height: 300px; transform: scale(0.75); transform-origin: center; position: relative; top: 38px;">
                        </div>
                        <table class="table p-2">
                            <tr class="row-table">
                                <th>Nama</th>
                                <td>:</td>
                                <td>Gibran</td>
                            </tr>
                            <tr class="row-table">
                                <th>Kelas</th>
                                <td>:</td>
                                <td>XI RPL D</td>
                            </tr>
                        </table>
                        <div class="card-body">
                            <input type="hidden" name="nama_kandidat" value="gibran">
                            <button class="btn btn-success w-100" type="submit">Pilih</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
