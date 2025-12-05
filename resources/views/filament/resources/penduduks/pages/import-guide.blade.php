<div
    class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm dark:border-gray-700">
    <table
        class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        {{-- Header Tabel --}}
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
            <tr>
                <th scope="col"
                    class="px-6 py-3 border-b dark:border-gray-700">
                    Nama Kolom (Excel)
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center border-b dark:border-gray-700">
                    Status
                </th>
                <th scope="col"
                    class="px-6 py-3 border-b dark:border-gray-700">
                    Keterangan / Contoh Data
                </th>
            </tr>
        </thead>

        {{-- Body Tabel --}}
        <tbody
            class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">

            {{-- Baris 1: Nama Lengkap --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-bold text-gray-900 dark:text-white font-mono">
                    nama_lengkap
                </td>
                <td class="px-6 py-4 text-center">
                    <span
                        class="font-bold text-red-600">WAJIB</span>
                </td>
                <td class="px-6 py-4">
                    Contoh: <strong>Budi
                        Santoso</strong>
                </td>
            </tr>

            {{-- Baris 2: Jenis Kelamin --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-bold text-gray-900 dark:text-white font-mono">
                    jenis_kelamin
                </td>
                <td class="px-6 py-4 text-center">
                    <span
                        class="font-bold text-red-600">WAJIB</span>
                </td>
                <td class="px-6 py-4">
                    Isi huruf <strong>L</strong>
                    (Laki-laki) atau
                    <strong>P</strong> (Perempuan)
                </td>
            </tr>

            {{-- Baris 3: Tempat Lahir --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white font-mono">
                    tempat_lahir
                </td>
                <td
                    class="px-6 py-4 text-center text-gray-400">
                    Opsional
                </td>
                <td class="px-6 py-4">
                    Contoh:
                    <strong>Bantul</strong>
                </td>
            </tr>

            {{-- Baris 4: Tanggal Lahir --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white font-mono">
                    tanggal_lahir
                </td>
                <td
                    class="px-6 py-4 text-center text-gray-400">
                    Opsional
                </td>
                <td class="px-6 py-4">
                    Format:
                    <strong>YYYY-MM-DD</strong>
                    (Contoh: 1990-12-31) atau
                    Format Date Excel
                </td>
            </tr>

            {{-- Baris 5: RT / RW --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white font-mono">
                    rt / rw
                </td>
                <td
                    class="px-6 py-4 text-center text-gray-400">
                    Opsional
                </td>
                <td class="px-6 py-4">
                    Contoh: <strong>001</strong> /
                    <strong>005</strong> (Gunakan
                    format teks agar nol di depan
                    tidak hilang)
                </td>
            </tr>

            {{-- Baris 6: Status Keluarga --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white font-mono">
                    status_keluarga
                </td>
                <td
                    class="px-6 py-4 text-center text-gray-400">
                    Opsional
                </td>
                <td class="px-6 py-4">
                    Contoh: <strong>Kepala
                        Keluarga</strong>,
                    <strong>Istri</strong>, atau
                    <strong>Anak</strong>
                </td>
            </tr>

            {{-- Baris 7: Alamat --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white font-mono">
                    alamat
                </td>
                <td
                    class="px-6 py-4 text-center text-gray-400">
                    Opsional
                </td>
                <td class="px-6 py-4">
                    Alamat jalan atau dusun
                </td>
            </tr>

            {{-- Baris 8: Agama --}}
            <tr
                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                <td
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white font-mono">
                    agama
                </td>
                <td
                    class="px-6 py-4 text-center text-gray-400">
                    Opsional
                </td>
                <td class="px-6 py-4">
                    Islam, Kristen, Katolik,
                    Hindu, Buddha, dll.
                </td>
            </tr>

        </tbody>
    </table>
</div>