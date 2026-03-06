<!DOCTYPE html>
<html>

<head>

    <title>Manajemen Mahasiswa</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h4>Manajemen Data Mahasiswa</h4>
            </div>

            <div class="card-body">

                <input type="hidden" id="id">

                <div class="row mb-3">

                    <div class="col">
                        <input type="text" id="npm" class="form-control" placeholder="NPM">
                    </div>

                    <div class="col">
                        <input type="text" id="nama" class="form-control" placeholder="Nama">
                    </div>

                    <div class="col">
                        <input type="text" id="jurusan" class="form-control" placeholder="Jurusan">
                    </div>

                    <div class="col">
                        <button class="btn btn-success" onclick="tambahData()">Tambah</button>
                        <button class="btn btn-warning" onclick="updateData()">Update</button>
                    </div>

                </div>

                <h5 class="mb-3">Daftar Mahasiswa</h5>

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataMahasiswa"></tbody>

                </table>

            </div>
        </div>
    </div>

    <script>
        function loadData() {

            fetch("api/read.php")
                .then(response => response.json())
                .then(result => {

                    let rows = ""
                    let mahasiswa = result.records

                    if (mahasiswa.length === 0) {
                        rows = `<tr><td colspan="6" class="text-center">Data belum ada</td></tr>`
                    }

                    mahasiswa.forEach((m, index) => {

                        rows += `
<tr>

<td>${index+1}</td>
<td>${m.id}</td>
<td>${m.npm}</td>
<td>${m.nama}</td>
<td>${m.jurusan}</td>

<td>

<button class="btn btn-warning btn-sm"
onclick="editData('${m.id}','${m.npm}','${m.nama}','${m.jurusan}')">
Edit
</button>

<button class="btn btn-danger btn-sm"
onclick="deleteData('${m.id}')">
Delete
</button>

</td>

</tr>
`

                    })

                    document.getElementById("dataMahasiswa").innerHTML = rows

                })

        }

        function tambahData() {

            fetch("api/create.php", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json"
                    },

                    body: JSON.stringify({

                        npm: document.getElementById("npm").value,
                        nama: document.getElementById("nama").value,
                        jurusan: document.getElementById("jurusan").value

                    })

                })

                .then(res => res.json())
                .then(data => {

                    alert(data.message)

                    loadData()

                    clearForm()

                })

        }

        function editData(id, npm, nama, jurusan) {

            document.getElementById("id").value = id
            document.getElementById("npm").value = npm
            document.getElementById("nama").value = nama
            document.getElementById("jurusan").value = jurusan

        }

        function updateData() {

            fetch("api/update.php", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json"
                    },

                    body: JSON.stringify({

                        id: document.getElementById("id").value,
                        npm: document.getElementById("npm").value,
                        nama: document.getElementById("nama").value,
                        jurusan: document.getElementById("jurusan").value

                    })

                })

                .then(res => res.json())
                .then(data => {

                    alert(data.message)

                    loadData()

                    clearForm()

                })

        }

        function deleteData(id) {

            if (confirm("Yakin ingin menghapus data?")) {

                fetch("api/delete.php", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/json"
                        },

                        body: JSON.stringify({
                            id: id
                        })

                    })

                    .then(res => res.json())
                    .then(data => {

                        alert(data.message)

                        loadData()

                    })

            }

        }

        function clearForm() {

            document.getElementById("id").value = ""
            document.getElementById("npm").value = ""
            document.getElementById("nama").value = ""
            document.getElementById("jurusan").value = ""

        }

        loadData()
    </script>

</body>

</html>