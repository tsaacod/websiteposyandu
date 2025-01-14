<title>{{ $title }}</title>
<x-layout>
    <x-slot:title>
        <div class="relative p-6 bg-gradient-to-r from-green-100 to-[#e3f2ed] rounded-lg shadow-md">
            <!-- Garis dekoratif atas -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-[#205937] rounded-full"></div>
            
            <div class="text-center">
                <!-- Ikon Ibu Hamil -->
                <i class="fas fa-female text-[#297F4C] text-5xl mb-2"></i>
                <h2 class="text-3xl text-[#205937] font-semibold">{{ $title }}</h2>
                <h1 class='font-bold text-xl mt-2'>Posyandu Sakura RW 08</h1>
            </div>
            
            <!-- Garis dekoratif bawah -->
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-[#205937] rounded-full"></div>
        </div>
    </x-slot:title>

     <!-- Notifikasi -->
     @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tombol tambah -->
<div class="relative group inline-block mb-4"> <!-- Memberikan margin bawah -->
    <a href="{{ route('ibu-hamil.create') }}" class='inline-block'>
        <button class="bg-[#297F4C] text-white px-4 py-2 flex items-center space-x-4 hover:scale-110 transition-transform rounded-md">
            <!-- Ikon Ibu Hamil -->
            <i class="fas fa-female text-xl"></i>
            <span>Tambah Ibu Hamil</span>
        </button>
    </a>
</div>

<a href="{{ route('ibu-hamil.visualisasi') }}" class='inline-block'>
    <button class="bg-[#007bff] text-white px-4 py-2 flex items-center space-x-4 hover:scale-110 transition-transform rounded-md ml-4">
        <i class="fas fa-chart-pie text-xl"></i>
        <span>Visualisasi Data Kehamilan</span>
    </button>
</a>

<a href="{{ route('ibu-hamil.export-pdf') }}" class='inline-block'>
    <button class="bg-[#007bff] text-white px-4 py-2 flex items-center space-x-4 hover:scale-110 transition-transform rounded-md ml-4">
        <i class="fas fa-file-pdf text-xl"></i>
        <span>Download PDF</span>
    </button>
</a>


    <!-- Pencarian -->
    <div class="mb-6 mt-4"> <!-- Memberikan margin atas dan bawah -->
        <input type="text" id="search" placeholder="Cari Ibu Hamil..." class="border border-gray-300 rounded-md px-4 py-2 w-full" onkeyup="searchTable()">
    </div>

    <!-- Table Ibu Hamil -->
    <table class="table-auto w-full border-collapse border border-gray-300 mt-3 rounded-lg shadow-sm overflow-hidden">
        <thead>
            <tr class="bg-[#205937] text-white">
                <th class="border border-gray-300 px-4 py-2 rounded-tl-lg">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Ibu</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Lahir</th>
                <th class="border border-gray-300 px-4 py-2">No Telepon</th>
                <th class="border border-gray-300 px-4 py-2">Alamat</th>
                <th class="border border-gray-300 px-4 py-2">Kehamilan Ke</th>
                <th class="border border-gray-300 px-4 py-2 rounded-tr-lg">Aksi</th>
            </tr>
        </thead>
        <tbody id="ibuHamilTable">
            @foreach ($ibuHamil as $data)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->Nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->TanggalLahir }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->NoTelepon }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->Alamat }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->kehamilan_ke }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex space-x-2 justify-center">
                    <style>
    .button-primary {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .button-secondary {
    background-color: #ffc107;
    color: black;
    padding: 8px 16px;
    border: none;
    border-radius : 5px;
    cursor: pointer;
  }

  .button-danger {
    background-color: #dc3545;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .button-primary:hover {
    background-color: #0056b3; 
  }

  .button-secondary:hover {
    background-color: #e0a800; 
  }

  .button-danger:hover {
    background-color: #c82333; 
  }
</style>

<!-- Tombol view -->
<a href="{{ route('ibu-hamil.show', $data->id) }}">
    <button class="button-primary">
        Lihat
    </button>
</a>
<!-- Tombol edit -->
<a href="{{ route('ibu-hamil.edit', $data->id) }}">
    <button class="button-secondary">
        Edit
    </button>
</a>
<!-- Tombol delete -->
<form action="{{ route('ibu-hamil.destroy', $data->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="button-danger">
        Hapus
    </button>
</form>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>

<script>
    function searchTable() {
        const input = document.getElementById("search");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("ibuHamilTable");
        const tr = table.getElementsByTagName("tr");

        for (let i = 0; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName("td");
            let found = false;
            for (let j = 1; j < td.length; j++) {
                if (td[j]) {
                    const txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    }
</script>