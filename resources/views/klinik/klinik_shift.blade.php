<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dinamis dengan Bootstrap</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Leaflet --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- end leaflet --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        h2.text-center {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            border-color: #4e73df;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
        }

        .input-group-text {
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 0 10px 10px 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Animasi untuk input shift baru */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mb-3.input-group {
            animation: fadeIn 0.3s ease-out;
        }

        #map {
            height: 300px;
            width: 100%;
            border-radius: 10px;
        }

        /* untuk tabel pencarian */
        .address {
            padding: 10px 15px;
            margin: 5px 0;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #2c3e50;
        }

        .address:hover {
            background-color: #4e73df;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.2);
        }

        /* Styling untuk container hasil pencarian */
        #results {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 10px;
            padding: 5px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Scrollbar styling */
        #results::-webkit-scrollbar {
            width: 8px;
        }

        #results::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #results::-webkit-scrollbar-thumb {
            background: #4e73df;
            border-radius: 4px;
        }

        #results::-webkit-scrollbar-thumb:hover {
            background: #224abe;
        }

        /* Loading state */
        .address.loading {
            position: relative;
            overflow: hidden;
        }

        .address.loading::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }
    </style>
    </style>

    @csrf
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">FORM PENGISIAN DATA PERUSAHAAN DAN DATA SHIFT</h2>
        <form action="{{ route('admin.officeShiftCreate') }}" method="POST">
            <div class="row">
                <div class="col-12 text-end mb-4">
                    <button type="submit" class="btn btn-primary text-right">Simpan Data</button>
                </div>
                <!-- Kolom Data Perusahaan -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Data Perusahaan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perusahaan</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    placeholder="Masukan Nama Perusahaan">
                                @error('nama')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group" id="search">
                                <label for="exampleInputAlamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="">
                                <button type="button" class="btn btn-primary mt-2 btn-sm"
                                    onclick="addr_search();">Tampilkan dipeta</button>
                                <div id="results">
                                </div>
                            </div>
                            {{-- Start Map --}}
                            <div class="form-group">
                                <div id="map"></div>
                                {{-- end map --}}
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="lat" class="form-control" id="lat" placeholder="">
                                @error('latitude')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="lon" class="form-control" id="lon"
                                    placeholder="Masukan longitude">
                                @error('longitude')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">Radius (meter)</label>
                                <div class="input-group">
                                    <input type="number" name="radius" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukan radius">
                                    <span class="input-group-text">m</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
        </form>
    </div>
    </div>

    <!-- Kolom Data Shift -->
    <div class="form-group col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Data Shift</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Shift</label>
                            <input type="text" name="nama_shift" class="form-control" placeholder="Nama Shift"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jam Masuk</label>
                            <input type="time" name="jam_masuk" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jam Keluar</label>
                            <input type="time" name="jam_keluar" class="form-control" required>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="button" class="btn btn-primary mt-2" id="addShift">Tambah Shift</button>
                {{-- <button type="submit" class="btn btn-success mt-2 ms-2">Simpan Semua Shift</button> --}}
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Start map --}}
    <script type="text/javascript">
        // Yogyakarta
        var startlat = -7.80119980;
        var startlon = 110.36466080;

        var options = {
            center: [startlat, startlon],
            zoom: 9,
        };

        document.getElementById("lat").value = startlat;
        document.getElementById("lon").value = startlon;

        var map = L.map("map", options);
        var nzoom = 12;

        L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
            attribution: "OSM",
        }).addTo(map);

        var myMarker = L.marker([startlat, startlon], {
                title: "Coordinates",
                alt: "Coordinates",
                draggable: true,
            })
            .addTo(map)
            .on("dragend", function() {
                var lat = myMarker.getLatLng().lat.toFixed(8);
                var lon = myMarker.getLatLng().lng.toFixed(8);
                var czoom = map.getZoom();
                if (czoom < 18) {
                    nzoom = czoom + 2;
                }
                if (nzoom > 18) {
                    nzoom = 18;
                }
                if (czoom != 18) {
                    map.setView([lat, lon], nzoom);
                } else {
                    map.setView([lat, lon]);
                }
                document.getElementById("lat").value = lat;
                document.getElementById("lon").value = lon;
                myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
            });

        function chooseAddr(lat1, lng1) {
            myMarker.closePopup();
            map.setView([lat1, lng1], 18);
            myMarker.setLatLng([lat1, lng1]);
            lat = lat1.toFixed(8);
            lon = lng1.toFixed(8);
            document.getElementById("lat").value = lat;
            document.getElementById("lon").value = lon;
            myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
        }

        function myFunction(arr) {
            var out = "<br />";
            var i;

            if (arr.length > 0) {
                for (i = 0; i < arr.length; i++) {
                    out +=
                        "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" +
                        arr[i].lat +
                        ", " +
                        arr[i].lon +
                        ");return false;'>" +
                        arr[i].display_name +
                        "</div>";
                }
                document.getElementById("results").innerHTML = out;
            } else {
                document.getElementById("results").innerHTML = "Sorry, no results...";
            }
        }

        function addr_search() {
            var inp = document.getElementById("alamat");
            var xmlhttp = new XMLHttpRequest();
            var url =
                "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" +
                inp.value;
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myArr = JSON.parse(this.responseText);
                    myFunction(myArr);
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    </script>
    {{-- End Map --}}


</body>

</html>
