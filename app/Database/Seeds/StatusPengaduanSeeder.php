<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusPengaduanSeeder extends Seeder
{
    public function run()
    {
        $statusPengaduan = [
            [
                'label' => 'Diterima',
                'deskripsi' => 'Pengaduan telah diterima oleh sistem dan sedang dalam proses verifikasi dan peninjauan awal.',
                'warna' => 'primary'
            ],
            [
                'label' => 'Sedang Diproses',
                'deskripsi' => 'Pengaduan telah melewati tahap verifikasi awal dan sedang dalam proses penanganan lebih lanjut.',
                'warna' => 'info'
            ],
            [
                'label' => 'Sedang Ditinjau',
                'deskripsi' => 'Pengaduan telah ditinjau oleh pihak yang berwenang dan sedang dalam tahap evaluasi lebih lanjut.',
                'warna' => 'warning'
            ],
            [
                'label' => 'Memerlukan Informasi Tambahan',
                'deskripsi' => 'Pengaduan memerlukan informasi tambahan dari pelapor sebelum dapat dilanjutkan ke tahap penanganan.',
                'warna' => 'warning'
            ],
            [
                'label' => 'Ditugaskan ke Tim Terkait',
                'deskripsi' => 'Pengaduan telah ditugaskan kepada tim yang bertanggung jawab untuk penanganan lebih lanjut.',
                'warna' => 'success'
            ],
            [
                'label' => 'Sedang Dalam Penanganan',
                'deskripsi' => 'Pengaduan sedang dalam proses penanganan aktif oleh tim terkait.',
                'warna' => 'info'
            ],
            [
                'label' => 'Menunggu Tindak Lanjut',
                'deskripsi' => 'Pengaduan telah ditangani dan sedang menunggu tindak lanjut atau keputusan selanjutnya.',
                'warna' => 'primary'
            ],
            [
                'label' => 'Selesai',
                'deskripsi' => 'Pengaduan telah ditangani dan telah selesai dengan tindakan yang sesuai.',
                'warna' => 'success'
            ],
            [
                'label' => 'Ditolak',
                'deskripsi' => 'Pengaduan telah ditinjau dan tidak memenuhi syarat atau tidak ada tindakan yang dapat diambil.',
                'warna' => 'danger'
            ],
            [
                'label' => 'Pengaduan Palsu',
                'deskripsi' => 'Pengaduan dikategorikan sebagai pengaduan palsu atau tidak beralasan.',
                'warna' => 'danger'
            ]
        ];

        $this->db->table('status_pengaduan')->insertBatch($statusPengaduan);
    }
}
