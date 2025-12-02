<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slider_beranda', function (Blueprint $table) {
            $table->id();
            $table->string('foto_path');
            $table->integer('urutan')->default(0);

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('profil_padukuhan', function (Blueprint $table) {
            $table->id();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('foto_struktur')->nullable();
            $table->decimal('luas_wilayah', 10, 2)->nullable();
            $table->integer('jumlah_rw')->nullable();
            $table->integer('jumlah_rt')->nullable();
            $table->string('foto_kepala_padukuhan')->nullable();
            $table->string('nama_kepala_padukuhan')->nullable();
            $table->text('sambutan_kepala_padukuhan')->nullable();
            $table->string('foto_tentang_padukuhan')->nullable();
            $table->text('deskripsi_tentang_padukuhan')->nullable();

            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('profil_karang_taruna', function (Blueprint $table) {
            $table->id();
            $table->string('foto_ketua')->nullable();
            $table->string('nama_ketua')->nullable();
            $table->text('sambutan_ketua')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('foto_struktur')->nullable();

            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('status_keluarga')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('agama')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('disabilitas')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('foto_usaha')->nullable();
            $table->string('nama_usaha');
            $table->string('pemilik')->nullable();
            $table->text('deskripsi_usaha')->nullable();
            $table->text('link_gmaps')->nullable();
            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('foto_kegiatan')->nullable();
            $table->string('nama_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->text('deskripsi_kegiatan')->nullable();
            $table->string('lokasi')->nullable();
            $table->boolean('is_published')->default(true);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('pustaka_warga', function (Blueprint $table) {
            $table->id();
            $table->string('foto_cover')->nullable();
            $table->string('nama_dokumen');
            $table->string('pemilik')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('link_dokumen')->nullable();
            $table->text('link_video')->nullable();
            $table->string('tipe_informasi');
            $table->boolean('is_published')->default(true);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('rt', 10)->nullable();
            $table->text('isi_pengaduan');
            $table->string('kategori');
            $table->string('status')->default('pending'); // Pending, Proses, Selesai
            $table->text('tanggapan')->nullable();

            $table->foreignId('ditangani_oleh')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('tanggal_pengaduan')->useCurrent();
            $table->timestamp('tanggal_tanggapan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('pengaduan');
        Schema::dropIfExists('pustaka_warga');
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('umkm');
        Schema::dropIfExists('penduduk');
        Schema::dropIfExists('profil_karang_taruna');
        Schema::dropIfExists('profil_padukuhan');
        Schema::dropIfExists('slider_beranda');
    }
};
