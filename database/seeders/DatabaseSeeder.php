<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\NavMenu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for LPMI (Lembaga Penjaminan Mutu Internal) STIKES Panti Waluya Malang.
     */
    public function run(): void
    {
        // 1. Create Super Admin and Division Admins
        $superAdmin = User::updateOrCreate(
            ['email' => 'it@pantiwaluya.ac.id'],
            [
                'name' => 'Super Admin (IT)',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $divisionAdmin = User::updateOrCreate(
            ['email' => 'lpmi@pantiwaluya.ac.id'],
            [
                'name' => 'Admin LPMI',
                'role' => 'division_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Aliases for compatibility
        User::updateOrCreate(
            ['email' => 'kemahasiswaan@pantiwaluya.ac.id'],
            [
                'name' => 'Admin Divisi (LPMI)',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'divisi@pantiwaluya.ac.id'],
            [
                'name' => 'Admin Divisi',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@pantiwaluya.ac.id'],
            [
                'name' => 'Super Admin Utama',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'berita@pantiwaluya.ac.id'],
            [
                'name' => 'Admin Konten LPMI',
                'role' => 'admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. LPMI Division Settings (Matched to spmi.stikespantiwaluya.ac.id)
        $defaultSettings = [
            // Identitas Divisi
            'division_name' => 'Lembaga Penjaminan Mutu Internal (LPMI)',
            'division_short_name' => 'LPMI STIKES Panti Waluya Malang',
            'division_acronym' => 'LPMI',
            'division_tagline' => 'Menjamin dan Meningkatkan Mutu Pendidikan Tinggi Secara Berkelanjutan',
            'parent_institution' => 'STIKES Panti Waluya Malang',
            'division_icon' => 'fa-solid fa-award',
            
            // Visual & Branding
            'theme_primary_color' => '#1e3a8a', // Deep Navy Blue (matching LPMI branding)
            'theme_secondary_color' => '#0284c7', // Sky-600
            'theme_accent_color' => '#d97706', // Amber-600
            'logo_url' => '/storage/logos/cropped-LPMI.png',
            'hero_banner_title' => 'Selamat Datang di Website LPMI STIKES Panti Waluya Malang',
            'hero_banner_subtitle' => 'Lembaga Penjaminan Mutu Internal (LPMI) merupakan unit kerja yang bertugas merancang, melaksanakan, mengendalikan, dan mengembangkan sistem penjaminan mutu di perguruan tinggi secara berkelanjutan dengan siklus PPEPP.',

            // Tentang & Visi Misi
            'about_title' => 'Tentang LPMI STIKes Panti Waluya Malang',
            'about_description' => 'Lembaga Penjaminan Mutu Internal STIKes Panti Waluya Malang merupakan unit kerja yang ada di STIKes Panti Waluya Malang. LPMI SPWM bekerja dan bertanggungjawab kepada Ketua STIKes Panti Waluya Malang dalam melaksanakan tugasnya untuk mengkoordinir, memfasilitasi dan menggerakkan proses perencanaan, pelaksanaan, koordinasi, pengendalian, dan mengembangkan sistem penjaminan mutu di perguruan tinggi.',
            'vision' => 'Menjamin dan meningkatkan mutu Perguruan Tinggi secara berkelanjutan berdasar pada pemenuhan Standar Pendidikan Tinggi (Standar Dikti) serta pengakuan akreditasi nasional dan internasional guna mewujudkan visi STIKes Panti Waluya Malang.',
            'mission' => "1. Menyelenggarakan penetapan standar mutu berdasar pada kebutuhan pelanggan dan pengembangan institusi.\n2. Menyelenggarakan pelaksanaan standar mutu berdasar pada kebutuhan pelanggan dan pengembangan institusi.\n3. Menyelenggarakan evaluasi pelaksanaan standar mutu berdasar pada kebutuhan pelanggan dan pengembangan institusi.\n4. Menyelenggarakan pengendalian pelaksanaan standar mutu berdasar pada hasil evaluasi pelaksanaan standar, kebutuhan pelanggan dan pengembangan institusi.\n5. Menyelenggarakan peningkatan mutu berdasar pada hasil evaluasi pelaksanaan standar, kebutuhan pelanggan dan pengembangan institusi.",
            
            // Kontak & Lokasi
            'contact_email' => 'info@stikespantiwaluya.ac.id',
            'contact_phone' => '0341-369003',
            'contact_whatsapp' => '6281234567890',
            'enable_whatsapp_floating' => '1',
            'whatsapp_floating_message' => 'Halo LPMI STIKES Panti Waluya, saya ingin bertanya terkait penjaminan mutu, survei, atau akreditasi.',
            'contact_room' => 'Kantor LPMI, Gedung Rektorat STIKES Panti Waluya Malang',
            'contact_address' => 'Jalan Yulius Usman No. 62, Kasin, Kec. Klojen, Kota Malang, Jawa Timur 65117',
            'operating_hours' => 'Senin - Jumat: 06:00 – 18:00 WIB',
            'google_maps_embed' => 'https://maps.google.com/maps?q=akper%20panti%20waluya&t=m&z=17&output=embed&iwloc=near',

            // Media Sosial & Website
            'social_instagram' => 'https://instagram.com/stikespantiwaluyamalang',
            'social_facebook' => 'https://facebook.com/stikespantiwaluyamalang',
            'social_youtube' => 'https://youtube.com/@stikespantiwaluya',
            'social_website' => 'https://spmi.stikespantiwaluya.ac.id',

            // Statistik Beranda
            'stat_1_number' => '100%',
            'stat_1_label' => 'Siklus PPEPP Berjalan',
            'stat_2_number' => '5',
            'stat_2_label' => 'Program Studi Terakreditasi',
            'stat_3_number' => '24+',
            'stat_3_label' => 'Standar Mutu SPMI Ditetapkan',
            'stat_4_number' => 'Baik Sekali',
            'stat_4_label' => 'Akreditasi BAN-PT & LAM-PTKes',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }

        // 3. Categories (Dokumen & Post)
        $catSpmi = Category::updateOrCreate(
            ['slug' => 'dokumen-spmi'],
            ['name' => 'Dokumen SPMI', 'type' => 'document', 'description' => 'Kebijakan, manual, standar mutu, dan SOP SPMI']
        );
        $catAmi = Category::updateOrCreate(
            ['slug' => 'laporan-ami'],
            ['name' => 'Audit Mutu Internal (AMI)', 'type' => 'document', 'description' => 'Laporan audit mutu internal per program studi']
        );
        $catMonev = Category::updateOrCreate(
            ['slug' => 'laporan-monev'],
            ['name' => 'Monitoring & Evaluasi', 'type' => 'document', 'description' => 'Laporan monitoring, evaluasi, dan RTM']
        );
        $catSurvei = Category::updateOrCreate(
            ['slug' => 'laporan-survei'],
            ['name' => 'Laporan Survei Kepuasan', 'type' => 'document', 'description' => 'Hasil survei kepuasan dosen, mahasiswa, tendik, dan stakeholder']
        );
        $catAkred = Category::updateOrCreate(
            ['slug' => 'akreditasi-regulasi'],
            ['name' => 'Akreditasi & Regulasi', 'type' => 'document', 'description' => 'Sertifikat akreditasi BAN-PT / LAM-PTKes dan regulasi nasional']
        );

        $catBeritaMutu = Category::updateOrCreate(
            ['slug' => 'berita-mutu'],
            ['name' => 'Berita & Kegiatan Mutu', 'type' => 'post', 'description' => 'Kegiatan audit, evaluasi, akreditasi, dan workshop mutu']
        );
        $catPengumumanMutu = Category::updateOrCreate(
            ['slug' => 'pengumuman-mutu'],
            ['name' => 'Pengumuman LPMI', 'type' => 'post', 'description' => 'Pengumuman jadwal AMI, pengisian survei, dan rapat tinjauan manajemen']
        );

        // 4. Sample Posts (Berita & Pengumuman LPMI)
        Post::updateOrCreate(
            ['slug' => 'pelaksanaan-audit-mutu-internal-ami-siklus-tahunan-stikes-panti-waluya-malang'],
            [
                'title' => 'Pelaksanaan Audit Mutu Internal (AMI) Siklus Tahunan STIKES Panti Waluya Malang',
                'category_id' => $catBeritaMutu->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'LPMI menggelar rangkaian audit mutu internal secara menyeluruh pada seluruh program studi dan unit kerja guna menjamin ketercapaian standar institusi.',
                'content' => '<p>Lembaga Penjaminan Mutu Internal (LPMI) STIKES Panti Waluya Malang melaksanakan kegiatan <strong>Audit Mutu Internal (AMI)</strong> sebagai wujud pelaksanaan siklus Evaluasi dan Pengendalian dalam sistem penjaminan mutu PPEPP.</p><p>Audit dilaksanakan oleh auditor internal bersertifikat yang memeriksa kesesuaian dokumen, proses pembelajaran, sarana prasarana, serta capaian Indikator Kinerja Utama (IKU) dan Indikator Kinerja Tambahan (IKT). Hasil audit dituangkan dalam Laporan Audit Mutu Internal untuk dibahas bersama pimpinan dalam Rapat Tinjauan Manajemen (RTM).</p>',
                'thumbnail' => '/storage/galleries/penerimaan-penganugerahan-kampus.jpg',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 342,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'pengisian-survei-kepuasan-layanan-civitas-akademika-semester-genap'],
            [
                'title' => 'Pengisian Survei Kepuasan Layanan Civitas Akademika Semester Genap',
                'category_id' => $catPengumumanMutu->id,
                'user_id' => $admin->id,
                'type' => 'pengumuman',
                'summary' => 'LPMI mengundang seluruh dosen, tenaga kependidikan, dan mahasiswa untuk berpartisipasi aktif dalam pengisian survei kepuasan layanan kampus.',
                'content' => '<p>Dalam rangka peningkatan kualitas mutu pelayanan akademik dan non-akademik di lingkungan STIKES Panti Waluya Malang, LPMI membuka <strong>Survei Kepuasan Civitas Akademika</strong>.</p><p>Kuesioner dapat diakses secara daring melalui menu Layanan > Survey Kepuasan di website resmi LPMI. Partisipasi dan masukan objektif dari seluruh civitas akademika sangat berharga dalam mewujudkan perbaikan berkelanjutan (continuous quality improvement).</p>',
                'thumbnail' => '/storage/galleries/banner-lpmi.png',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 512,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'penganugerahan-prestasi-akreditasi-institusi-dan-program-studi-stikes-panti-waluya-malang'],
            [
                'title' => 'Pencapaian Akreditasi Unggul & Baik Sekali Institusi dan Seluruh Program Studi',
                'category_id' => $catBeritaMutu->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'STIKES Panti Waluya Malang berhasil mempertahankan status akreditasi dengan predikat membanggakan dari BAN-PT dan LAM-PTKes.',
                'content' => '<p>Melalui kerja keras dan komitmen bersama seluruh civitas akademika di bawah pendampingan penjaminan mutu LPMI, STIKES Panti Waluya Malang berhasil meraih pencapaian akreditasi membanggakan dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) serta Lembaga Akreditasi Mandiri Pendidikan Tinggi Kesehatan (LAM-PTKes).</p><p>Sertifikat akreditasi resmi dapat diakses dan diunduh oleh civitas akademika serta masyarakat melalui halaman Akreditasi & Regulasi di website LPMI.</p>',
                'thumbnail' => '/storage/akreditasi/sertifikat-akreditasi-ban-pt-2025.jpg',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views_count' => 789,
            ]
        );

        // 5. LPMI Services (Layanan Mutu)
        Service::updateOrCreate(
            ['slug' => 'pengaduan-mutu'],
            [
                'title' => 'Layanan Pengaduan Mutu',
                'icon' => 'fa-solid fa-bullhorn',
                'summary' => 'Fasilitas penyampaian masukan, keluhan, dan saran konstruktif terkait mutu layanan akademik maupun non-akademik.',
                'description' => 'LPMI menyediakan kanal pengaduan mutu daring yang aman, transparan, dan terpercaya bagi mahasiswa, dosen, tenaga kependidikan, serta masyarakat untuk menyampaikan keluhan terkait standar pelayanan STIKES Panti Waluya Malang.',
                'requirements' => "1. Identitas pelapor atau anonim yang bertanggung jawab\n2. Uraian lengkap kejadian / ketidaksesuaian standar mutu\n3. Bukti pendukung (dokumen/foto jika ada)",
                'procedure' => "1. Klik tautan formulir Pengaduan Mutu daring.\n2. Isi form pengaduan secara lengkap.\n3. Tim LPMI melakukan verifikasi dan investigasi awal.\n4. Pembahasan bersama unit terkait untuk langkah perbaikan.\n5. Umpan balik hasil tindak lanjut disampaikan kepada pelapor.",
                'download_form_link' => 'https://forms.gle/Dy9w93G3cTWnuaFL7',
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'pengajuan-dokumen-mutu'],
            [
                'title' => 'Pengajuan & Revisi Dokumen Mutu',
                'icon' => 'fa-solid fa-file-signature',
                'summary' => 'Layanan pengusulan standar baru, revisi SOP, formulir mutu, dan pedoman kerja bagi seluruh unit kerja.',
                'description' => 'Memfasilitasi program studi dan unit kerja dalam menyusun, mengajukan pengesahan, maupun memperbarui Standar Operasional Prosedur (SOP), Formulir Mutu, dan Manual Kerja agar selaras dengan regulasi terbaru.',
                'requirements' => "1. Draf dokumen mutu yang diajukan\n2. Lembar justifikasi / latar belakang perubahan standar\n3. Persetujuan pimpinan unit pemohon",
                'procedure' => "1. Pengusul mengisi formulir Pengajuan Dokumen Mutu.\n2. Tim Koordinator Pengembangan Dokumen Mutu LPMI mereviu draf.\n3. Rapat sinkronisasi dan uji kelayakan dokumen.\n4. Penomoran dan pengesahan resmi dokumen mutu oleh pimpinan institusi.",
                'download_form_link' => 'https://forms.gle/xgxqBtrso39iddj16',
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'audit-mutu-internal-ami'],
            [
                'title' => 'Audit Mutu Internal (AMI)',
                'icon' => 'fa-solid fa-clipboard-check',
                'summary' => 'Penyelenggaraan audit mutu akademik dan non-akademik secara berkala berbasis instrumen standar SN-Dikti.',
                'description' => 'Audit Mutu Internal adalah pemeriksaan berkala yang dilakukan secara objektif dan sistematis untuk memverifikasi apakah seluruh aktivitas tridharma dan tata kelola perguruan tinggi telah memenuhi standar mutu yang ditetapkan.',
                'requirements' => "1. Laporan Evaluasi Diri (LED) program studi / unit kerja\n2. Dokumen portofolio capaian standar mutu periode berjalan",
                'procedure' => "1. Penetapan jadwal dan penugasan tim auditor internal.\n2. Desk evaluation dokumen mutu auditee.\n3. Visitasi lapangan dan wawancara klarifikasi.\n4. Penandatanganan berita acara dan penyampaian temuan KTS/OB.\n5. Penyusunan Rencana Tindak Lanjut (RTL) pada Rapat Tinjauan Manajemen.",
                'download_form_link' => '/halaman/halaman-ami',
                'order_index' => 3,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'survei-kepuasan-pelanggan'],
            [
                'title' => 'Survei Kepuasan Civitas Akademika',
                'icon' => 'fa-solid fa-square-poll-vertical',
                'summary' => 'Pengukuran kepuasan berkala bagi dosen, tendik, mahasiswa, alumni, dan stakeholder institusi.',
                'description' => 'Survei kepuasan digunakan sebagai instrumen evaluasi kinerja layanan institusi guna mengetahui tingkat kepuasan pemangku kepentingan dan merumuskan prioritas peningkatan mutu.',
                'requirements' => "1. Kuesioner daring resmi LPMI\n2. Responden aktif civitas akademika atau mitra STIKES Panti Waluya",
                'procedure' => "1. Pemilihan kategori responden (Dosen, Mahasiswa, Tendik, Alumni, Mitra).\n2. Pengisian kuesioner pada link yang disediakan.\n3. Pengolahan data statistik oleh Tim Monev LPMI.\n4. Publikasi Laporan Survei Kepuasan tahunan.",
                'download_form_link' => '/halaman/laporansurveykepuasan-2',
                'order_index' => 4,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'pendampingan-akreditasi-institusi-dan-prodi'],
            [
                'title' => 'Pendampingan Akreditasi Program Studi',
                'icon' => 'fa-solid fa-certificate',
                'summary' => 'Fasilitasi penyusunan dokumen akreditasi, simulasi asesmen lapangan, dan pendampingan BAN-PT / LAM-PTKes.',
                'description' => 'LPMI mendampingi program studi dalam mempersiapkan Laporan Evaluasi Diri (LED), Laporan Kinerja Program Studi (LKPS), simulasi asesmen lapangan, hingga tindak lanjut rekomendasi asesor akreditasi.',
                'requirements' => "1. SK Tim Akreditasi Program Studi\n2. Draf LKPS dan LED sesuai format instrumen akreditasi 9 kriteria",
                'procedure' => "1. Pembentukan tim taskforce akreditasi prodi.\n2. Bimbingan teknis penyusunan data kuantitatif LKPS bersama LPMI.\n3. Reviu dokumen LED oleh reviewer internal.\n4. Simulasi visitasi lapangan (mock accreditation).\n5. Pendampingan selama Asesmen Lapangan resmi berlangsung.",
                'download_form_link' => '/halaman/akred-regulasi',
                'order_index' => 5,
                'is_active' => true,
            ]
        );

        // 6. Real LPMI Team Members (Matched to spmi.stikespantiwaluya.ac.id)
        $team = [
            [
                'name' => 'Ns. Febrina Secsaria Handini, M.Kep.',
                'title_degree' => 'M.Kep.',
                'identifier' => 'Kepala LPMI',
                'position' => 'Kepala Lembaga Penjaminan Mutu Internal',
                'photo' => '/storage/team/febrina-secsaria-handini.png',
                'bio' => 'Menegakkan pelaksanaan penjaminan mutu di lingkungan STIKes Panti Waluya Malang (SPWM) berdasarkan siklus PPEPP dan didasarkan pada Undang-undang yang berlaku.',
                'email' => 'febrina.handini@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 1,
            ],
            [
                'name' => 'Atanasius Omega Dewantara, SE',
                'title_degree' => 'SE',
                'identifier' => 'Sekretaris & Administrasi',
                'position' => 'Sekretaris dan Administrasi LPMI',
                'photo' => '/storage/team/atanasius-omega-dewantara.png',
                'bio' => 'Membantu mengatur sistem manajemen administrasi di Lembaga Penjaminan Mutu Internal (LPMI) STIKes Panti Waluya Malang.',
                'email' => 'atanasius.omega@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 2,
            ],
            [
                'name' => 'Ns. Oktavia Indriyani, S.Kep.',
                'title_degree' => 'S.Kep.',
                'identifier' => 'Koordinator Teknologi',
                'position' => 'Koordinator Bidang Pengembangan Teknologi LPMI',
                'photo' => '/storage/team/oktavia-indriyani.png',
                'bio' => 'Membantu mengatur sistem teknologi informasi di Lembaga Penjaminan Mutu Internal (LPMI) STIKes Panti Waluya Malang.',
                'email' => 'oktavia.indriyani@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 3,
            ],
            [
                'name' => 'Ns. Maria Prieska Putri P. A., S.Kep., M.Kes.',
                'title_degree' => 'S.Kep., M.Kes.',
                'identifier' => 'Koordinator Monev',
                'position' => 'Koordinator Bidang Monev dan Survey Kepuasan LPMI',
                'photo' => '/storage/team/maria-prieska-putri.png',
                'bio' => 'Membantu mengatur sistem monitoring evaluasi dan survey kepuasan di STIKes Panti Waluya Malang.',
                'email' => 'maria.prieska@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 4,
            ],
            [
                'name' => 'Wisoedhanie Widi Anugrahati, S.K.M., M.Kes.',
                'title_degree' => 'S.K.M., M.Kes.',
                'identifier' => 'Koordinator AMI',
                'position' => 'Koordinator Bidang Audit Mutu Internal LPMI',
                'photo' => '/storage/team/wisoedhanie-widi-anugrahati.png',
                'bio' => 'Membantu mengatur pelaksanaan audit mutu internal (AMI) di STIKes Panti Waluya Malang.',
                'email' => 'wisoedhanie.widi@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 5,
            ],
            [
                'name' => 'Venny Kurnia Andika, S.Si., M.Biotech',
                'title_degree' => 'S.Si., M.Biotech',
                'identifier' => 'Koordinator AMI',
                'position' => 'Koordinator Bidang Audit Mutu Internal LPMI',
                'photo' => '/storage/team/venny-kurnia-andika.png',
                'bio' => 'Membantu mengatur pelaksanaan audit mutu internal (AMI) di STIKes Panti Waluya Malang.',
                'email' => 'venny.kurnia@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 6,
            ],
            [
                'name' => 'Ns. Oda Debora, S.Kep.',
                'title_degree' => 'S.Kep.',
                'identifier' => 'Koordinator Dokumen Mutu',
                'position' => 'Koordinator Bidang Pengembangan Dokumen Mutu LPMI',
                'photo' => '/storage/team/oda-debora.png',
                'bio' => 'Membantu mengatur pelaksanaan pengembangan dokumen mutu di STIKes Panti Waluya Malang.',
                'email' => 'oda.debora@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 7,
            ],
            [
                'name' => 'Ns. Narita Diatanti, S.Kep',
                'title_degree' => 'S.Kep.',
                'identifier' => 'Koordinator Dokumen Mutu',
                'position' => 'Koordinator Bidang Pengembangan Dokumen Mutu LPMI',
                'photo' => '/storage/team/narita-diatanti.png',
                'bio' => 'Membantu mengatur pelaksanaan pengembangan dokumen mutu di STIKes Panti Waluya Malang.',
                'email' => 'narita.diatanti@pantiwaluya.ac.id',
                'phone' => '0341-369003',
                'order_index' => 8,
            ],
        ];

        foreach ($team as $m) {
            TeamMember::updateOrCreate(['name' => $m['name']], $m);
        }

        // 7. LPMI Events / Agenda
        Event::updateOrCreate(
            ['slug' => 'audit-mutu-internal-ami-semester-genap-2025-2026'],
            [
                'title' => 'Audit Mutu Internal (AMI) Akademik Semester Genap 2025/2026',
                'location' => 'Seluruh Program Studi & Ruang Rapat LPMI STIKES Panti Waluya',
                'start_date' => now()->addDays(14)->setTime(8, 30),
                'end_date' => now()->addDays(16)->setTime(16, 0),
                'description' => 'Visitasi lapangan dan klarifikasi audit mutu internal oleh tim auditor LPMI pada Prodi S1 Keperawatan, Profesi Ners, S1 Farmasi, dan D4 MIK.',
                'registration_link' => '/halaman/halaman-ami',
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['slug' => 'rapat-tinjauan-manajemen-rtm-hasil-ami-tahunan'],
            [
                'title' => 'Rapat Tinjauan Manajemen (RTM) Hasil Audit Mutu Internal',
                'location' => 'Auditorium STIKES Panti Waluya Malang',
                'start_date' => now()->addDays(28)->setTime(9, 0),
                'end_date' => now()->addDays(28)->setTime(14, 0),
                'description' => 'Pemaparan temuan audit mutu, penetapan rekomendasi pengendalian, dan perumusan Rencana Tindak Lanjut (RTL) bersama pimpinan institusi.',
                'registration_link' => '/halaman/dokumen-spmi',
                'is_active' => true,
            ]
        );

        // 8. LPMI Documents (Matched to Drive links on spmi.stikespantiwaluya.ac.id)
        $documents = [
            [
                'title' => 'Dokumen Rencana Strategis (Renstra) Institusi STIKES Panti Waluya Malang',
                'category_id' => $catSpmi->id,
                'file_path' => 'https://drive.google.com/file/d/1YPc2CRsVJoLWqyQG4xeZ01kc9-X35Kzv/view?usp=drive_link',
                'file_type' => 'PDF',
                'file_size' => 'Google Drive',
                'description' => 'Dokumen arah kebijakan dan rencana strategis jangka menengah institusi.',
            ],
            [
                'title' => 'Dokumen Rencana Operasional (Renop) Institusi',
                'category_id' => $catSpmi->id,
                'file_path' => 'https://drive.google.com/drive/folders/1ycvGF9eyfy1cYTTS-589HHqIlcsL5yQg?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Kumpulan rencana operasional tahunan unit kerja dan program studi.',
            ],
            [
                'title' => 'Dokumen Kebijakan SPMI STIKES Panti Waluya Malang',
                'category_id' => $catSpmi->id,
                'file_path' => 'https://drive.google.com/file/d/18RCOMR2QteF4gctv40__g3SZp-BCw1I8/view?usp=drive_link',
                'file_type' => 'PDF',
                'file_size' => 'Google Drive',
                'description' => 'Kebijakan resmi sistem penjaminan mutu internal STIKES Panti Waluya Malang.',
            ],
            [
                'title' => 'Standar SNDIKTI & SNPT STIKES Panti Waluya Malang',
                'category_id' => $catSpmi->id,
                'file_path' => 'https://drive.google.com/drive/folders/1Sv0ZO3qRocBa6yeaNBvdnxdQNgkxQmGy?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Dokumen standar pendidikan, penelitian, pengabdian, dan standar tata pamong.',
            ],
            [
                'title' => 'Standar Operasional Prosedur (SOP) Institusi',
                'category_id' => $catSpmi->id,
                'file_path' => 'https://drive.google.com/drive/folders/1QBryp28QyWJkWlYYti9qwmFN84mHCfnc?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Kumpulan SOP baku pelaksanaan proses akademik dan penunjang.',
            ],
            [
                'title' => 'Kumpulan Formulir Mutu SPMI',
                'category_id' => $catSpmi->id,
                'file_path' => 'https://drive.google.com/drive/folders/17VIWEdXyLRdztCxpCwJcd8kYUYad688q?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Formulir pencatatan, pemantauan, dan evaluasi pelaksanaan standar.',
            ],
            [
                'title' => 'Laporan Audit Mutu Internal (AMI)',
                'category_id' => $catAmi->id,
                'file_path' => 'https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Dokumen laporan hasil AMI seluruh program studi per tahun.',
            ],
            [
                'title' => 'Laporan Monitoring dan Evaluasi (MONEV)',
                'category_id' => $catMonev->id,
                'file_path' => 'https://drive.google.com/drive/folders/1s8QOMcfcOGr0HlJJ1SIqDd7YHEHPyCvG?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Laporan monitoring berkala kegiatan tridharma dan unit kerja.',
            ],
            [
                'title' => 'Laporan Hasil Survei Kepuasan Civitas Akademika',
                'category_id' => $catSurvei->id,
                'file_path' => 'https://drive.google.com/drive/folders/1IQ3r6WrJU3nIOpVLrHLzXzjP-_2NcVSH?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Analisis hasil survei kepuasan dosen, mahasiswa, tendik, dan pengguna lulusan.',
            ],
            [
                'title' => 'Laporan Rapat Tinjauan Manajemen (RTM)',
                'category_id' => $catMonev->id,
                'file_path' => 'https://drive.google.com/drive/folders/14-mFE32BRvJ3q3cHOQ-8OqrXyn75XHdQ?usp=drive_link',
                'file_type' => 'FOLDER',
                'file_size' => 'Google Drive',
                'description' => 'Notulensi dan rumusan tindak lanjut rapat tinjauan manajemen.',
            ],
            [
                'title' => 'Regulasi Permendiktisaintek No 39 Tahun 2025 tentang Penjaminan Mutu',
                'category_id' => $catAkred->id,
                'file_path' => 'https://drive.google.com/file/d/1-A6PSNdCXQHzeZtv6m5NBZertxHx0ZOb/view?usp=sharing',
                'file_type' => 'PDF',
                'file_size' => 'Google Drive',
                'description' => 'Peraturan Menteri Pendidikan Tinggi, Sains, dan Teknologi terkait standar dan penjaminan mutu pendidikan tinggi.',
            ],
        ];

        foreach ($documents as $doc) {
            Document::updateOrCreate(
                ['title' => $doc['title']],
                array_merge($doc, ['downloads_count' => rand(50, 400), 'is_published' => true])
            );
        }

        // 9. LPMI Photo Galleries
        $galleries = [
            [
                'title' => 'Banner LPMI STIKES Panti Waluya Malang',
                'category' => 'Identitas',
                'image_path' => '/storage/galleries/banner-lpmi.png',
                'caption' => 'Banner Resmi Lembaga Penjaminan Mutu Internal (LPMI) STIKes Panti Waluya Malang.',
            ],
            [
                'title' => 'Penganugerahan Prestasi Kampus STIKES Panti Waluya Malang',
                'category' => 'Prestasi',
                'image_path' => '/storage/galleries/photo-penganugerahan-kampus.png',
                'caption' => 'Penerimaan sertifikat anugerah kampus berprestasi dalam tata kelola dan penjaminan mutu.',
            ],
            [
                'title' => 'Sertifikat Penganugerahan Kampus Berprestasi Ristekdikti',
                'category' => 'Penghargaan',
                'image_path' => '/storage/galleries/sertifikat-penganugerahan-kampus.png',
                'caption' => 'Piagam penghargaan atas tata kelola mutu dan kinerja institusi unggul.',
            ],
            [
                'title' => 'Sertifikat Akreditasi Perguruan Tinggi BAN-PT 2025',
                'category' => 'Akreditasi',
                'image_path' => '/storage/akreditasi/sertifikat-akreditasi-ban-pt-2025.jpg',
                'caption' => 'Sertifikat Akreditasi Institusi STIKES Panti Waluya Malang resmi dari BAN-PT.',
            ],
            [
                'title' => 'Gedung Kampus STIKES Panti Waluya Malang',
                'category' => 'Fasilitas',
                'image_path' => '/storage/galleries/gedung-skew.jpg',
                'caption' => 'Gedung Kampus STIKES Panti Waluya Malang di Jalan Yulius Usman No. 62 Malang.',
            ],
            [
                'title' => 'Dokumentasi Prestasi Civitas Akademika',
                'category' => 'Kegiatan',
                'image_path' => '/storage/galleries/prestasi.jpg',
                'caption' => 'Capaian prestasi dosen dan mahasiswa dalam bidang akademik dan penjaminan mutu.',
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::updateOrCreate(['title' => $gal['title']], $gal);
        }

        // 10. Carousel Banner Slides (Downloaded Real Images from spmi.stikespantiwaluya.ac.id)
        $carousels = [
            [
                'title' => 'Sistem Penjaminan Mutu Internal (SPMI)',
                'subtitle' => 'Membangun budaya mutu perguruan tinggi yang berkualitas, akuntabel, dan berkelanjutan berlandaskan siklus PPEPP.',
                'image_path' => '/storage/carousels/beranda-web-1.jpg',
                'button_text' => 'Dokumen SPMI',
                'button_link' => '/halaman/dokumen-spmi',
                'order_index' => 1,
                'show_overlay' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Audit Mutu Internal (AMI) Berkala',
                'subtitle' => 'Memastikan kesesuaian dan efektivitas implementasi standar pendidikan tinggi di seluruh program studi.',
                'image_path' => '/storage/carousels/beranda-web-2.jpg',
                'button_text' => 'Halaman AMI',
                'button_link' => '/halaman/halaman-ami',
                'order_index' => 2,
                'show_overlay' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Akreditasi Institusi & Program Studi',
                'subtitle' => 'Pengakuan mutu eksternal berstandar nasional dan internasional dari BAN-PT serta LAM-PTKes.',
                'image_path' => '/storage/carousels/beranda-web-3.jpg',
                'button_text' => 'Lihat Akreditasi',
                'button_link' => '/halaman/akred-regulasi',
                'order_index' => 3,
                'show_overlay' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Layanan & Pengaduan Mutu Terpadu',
                'subtitle' => 'Fasilitasi survei kepuasan, pengajuan dokumen mutu, dan pengaduan mutu daring secara transparan.',
                'image_path' => '/storage/carousels/beranda-web-4.jpg',
                'button_text' => 'Layanan Mutu',
                'button_link' => '/layanan',
                'order_index' => 4,
                'show_overlay' => true,
                'is_active' => true,
            ],
        ];

        foreach ($carousels as $c) {
            Carousel::updateOrCreate(['order_index' => $c['order_index']], $c);
        }

        // 11. Dynamic Pages (Matched Content from spmi.stikespantiwaluya.ac.id)
        $pages = [
            [
                'slug' => 'profil-lpmi',
                'title' => 'Profil LPMI',
                'banner_image' => null,
                'order_index' => 1,
                'is_published' => true,
                'content' => '
                    <div class="space-y-6">
                        <div class="rounded-2xl overflow-hidden shadow-md border border-slate-200">
                            <img src="/storage/organization/profil-lpmi.jpg" alt="Profil LPMI" class="w-full object-cover">
                        </div>
                        <div class="prose max-w-none text-slate-700 space-y-4">
                            <h3 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">Lembaga Penjaminan Mutu Internal STIKes Panti Waluya Malang</h3>
                            <p class="leading-relaxed">
                                Lembaga Penjaminan Mutu Internal STIKes Panti Waluya Malang merupakan unit kerja yang ada di STIKes Panti Waluya Malang. LPMI SPWM bekerja dan bertanggungjawab kepada Ketua STIKes Panti Waluya Malang dalam melaksanakan tugasnya untuk mengkoordinir, memfasilitasi dan menggerakkan proses perencanaan, pelaksanaan, koordinasi, pengendalian, dan mengembangkan sistem penjaminan mutu di lingkungan perguruan tinggi.
                            </p>
                            <p class="leading-relaxed">
                                Pelaksanaan penjaminan mutu dilakukan melalui <strong>Sistem Penjaminan Mutu Internal (SPMI)</strong> dengan siklus <strong>PPEPP</strong> (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan), serta didukung oleh Sistem Penjaminan Mutu Eksternal (SPME) melalui proses akreditasi dan evaluasi eksternal. Melalui sistem tersebut, LPMI berkomitmen untuk menjamin terpenuhinya standar mutu, mendorong perbaikan berkelanjutan (continuous improvement), dan mendukung pencapaian visi dan misi perguruan tinggi.
                            </p>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'visi-misi',
                'title' => 'Visi & Misi LPMI',
                'banner_image' => '/storage/carousels/beranda-web-1.jpg',
                'order_index' => 2,
                'is_published' => true,
                'content' => '
                    <div class="space-y-8">
                        <div class="p-6 bg-sky-50 border-l-4 border-sky-600 rounded-r-xl">
                            <h3 class="text-xl font-bold text-sky-950 mb-2 flex items-center">
                                <i class="fa-solid fa-eye text-sky-600 mr-3"></i> Visi LPMI STIKes Panti Waluya Malang
                            </h3>
                            <p class="text-slate-800 text-base leading-relaxed">
                                Menjamin dan meningkatkan mutu Perguruan Tinggi secara berkelanjutan berdasar pada pemenuhan Standar Pendidikan Tinggi (Standar Dikti) serta pengakuan akreditasi nasional dan internasional guna mewujudkan visi STIKes Panti Waluya Malang.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center">
                                <i class="fa-solid fa-bullseye text-emerald-600 mr-3"></i> Misi LPMI
                            </h3>
                            <ol class="list-decimal list-inside space-y-3 text-slate-700 bg-white p-6 rounded-xl border border-slate-200">
                                <li class="leading-relaxed"><strong>Menyelenggarakan penetapan standar mutu</strong> berdasar pada kebutuhan pelanggan dan pengembangan institusi.</li>
                                <li class="leading-relaxed"><strong>Menyelenggarakan pelaksanaan standar mutu</strong> berdasar pada kebutuhan pelanggan dan pengembangan institusi.</li>
                                <li class="leading-relaxed"><strong>Menyelenggarakan evaluasi pelaksanaan standar mutu</strong> berdasar pada kebutuhan pelanggan dan pengembangan institusi.</li>
                                <li class="leading-relaxed"><strong>Menyelenggarakan pengendalian pelaksanaan standar mutu</strong> berdasar pada hasil evaluasi pelaksanaan standar, kebutuhan pelanggan dan pengembangan institusi.</li>
                                <li class="leading-relaxed"><strong>Menyelenggarakan peningkatan mutu</strong> berdasar pada hasil evaluasi pelaksanaan standar, kebutuhan pelanggan dan pengembangan institusi.</li>
                            </ol>
                        </div>

                        <div class="p-6 bg-amber-50 border-l-4 border-amber-500 rounded-r-xl">
                            <h3 class="text-xl font-bold text-amber-950 mb-2 flex items-center">
                                <i class="fa-solid fa-flag text-amber-600 mr-3"></i> Tujuan
                            </h3>
                            <p class="text-slate-800 text-base leading-relaxed">
                                Menjamin pemenuhan Standar Pendidikan Tinggi (Standar Dikti) secara sistemik dan berkelanjutan, sehingga tumbuh dan berkembang budaya mutu di STIKes Panti Waluya Malang.
                            </p>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'tugas-fungsi',
                'title' => 'Tugas & Fungsi LPMI',
                'banner_image' => '/storage/carousels/beranda-web-2.jpg',
                'order_index' => 3,
                'is_published' => true,
                'content' => '
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl font-bold">
                                <i class="fa-solid fa-tasks"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Tugas LPMI</h3>
                            <p class="text-slate-700 leading-relaxed">
                                LPMI bertugas merencanakan, melaksanakan, mengoordinasikan, mengendalikan, dan mengembangkan Sistem Penjaminan Mutu Internal (SPMI) secara berkelanjutan dalam rangka menjamin dan meningkatkan mutu penyelenggaraan pendidikan tinggi di STIKes Panti Waluya Malang.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl font-bold">
                                <i class="fa-solid fa-cogs"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Fungsi LPMI</h3>
                            <p class="text-slate-700 leading-relaxed">
                                Menyusun standar mutu, melaksanakan monitoring dan evaluasi, melakukan audit mutu internal (AMI), serta mendampingi persiapan dan pelaksanaan akreditasi guna mewujudkan budaya mutu di perguruan tinggi.
                            </p>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'struktur-organisasi',
                'title' => 'Struktur Organisasi LPMI',
                'banner_image' => null,
                'order_index' => 4,
                'is_published' => true,
                'content' => '
                    <div class="space-y-8">
                        <div class="rounded-2xl overflow-hidden shadow-md border border-slate-200 bg-white p-4">
                            <h4 class="text-lg font-bold text-slate-900 mb-3 text-center">Bagan Struktur Organisasi LPMI</h4>
                            <img src="/storage/organization/struktur-organisasi-lpmi.jpg" alt="Bagan Struktur Organisasi LPMI" class="w-full object-contain mx-auto rounded-lg">
                        </div>

                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-4 border-b pb-2">Rincian Tugas Pokok Tim LPMI</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/febrina-secsaria-handini.png" alt="Ns. Febrina" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Ns. Febrina Secsaria Handini, M.Kep.</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Kepala Lembaga Penjaminan Mutu Internal</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Menegakkan pelaksanaan penjaminan mutu di lingkungan STIKes Panti Waluya Malang berdasarkan siklus PPEPP dan didasarkan pada perundang-undangan yang berlaku.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/atanasius-omega-dewantara.png" alt="Atanasius Omega" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Atanasius Omega Dewantara, SE</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Sekretaris dan Administrasi LPMI</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur sistem manajemen administrasi di Lembaga Penjaminan Mutu Internal (LPMI) STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/oktavia-indriyani.png" alt="Ns. Oktavia" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Ns. Oktavia Indriyani, S.Kep.</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Koordinator Bidang Pengembangan Teknologi LPMI</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur sistem teknologi informasi di Lembaga Penjaminan Mutu Internal (LPMI) STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/maria-prieska-putri.png" alt="Ns. Maria Prieska" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Ns. Maria Prieska Putri P. A., S.Kep., M.Kes.</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Koordinator Bidang Monev & Survey Kepuasan</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur sistem monitoring evaluasi dan survey kepuasan di STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/wisoedhanie-widi-anugrahati.png" alt="Wisoedhanie Widi" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Wisoedhanie Widi Anugrahati, S.K.M., M.Kes.</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Koordinator Bidang Audit Mutu Internal (AMI)</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur pelaksanaan audit mutu internal (AMI) di STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/venny-kurnia-andika.png" alt="Venny Kurnia" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Venny Kurnia Andika S.Si., M.Biotech</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Koordinator Bidang Audit Mutu Internal (AMI)</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur pelaksanaan audit mutu internal (AMI) di STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/oda-debora.png" alt="Ns. Oda Debora" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Ns. Oda Debora, S.Kep.</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Koordinator Bidang Pengembangan Dokumen Mutu</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur pelaksanaan pengembangan dokumen mutu di STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>

                                <div class="p-5 bg-white rounded-xl border border-slate-200 flex gap-4 items-start shadow-sm">
                                    <img src="/storage/team/narita-diatanti.png" alt="Ns. Narita" class="w-20 h-20 rounded-full object-cover border-2 border-sky-500 flex-shrink-0">
                                    <div>
                                        <h5 class="font-bold text-slate-900">Ns. Narita Diatanti, S.Kep</h5>
                                        <p class="text-xs text-sky-700 font-semibold mb-1">Koordinator Bidang Pengembangan Dokumen Mutu</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">Membantu mengatur pelaksanaan pengembangan dokumen mutu di STIKes Panti Waluya Malang.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'dokumen-spmi',
                'title' => 'Dokumen SPMI',
                'banner_image' => '/storage/carousels/beranda-web-3.jpg',
                'order_index' => 5,
                'is_published' => true,
                'content' => '
                    <div class="space-y-6 text-slate-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="text-sky-600 text-2xl font-bold"><i class="fa-solid fa-book-bookmark"></i></div>
                                <h4 class="text-lg font-bold text-slate-900">Kebijakan Mutu</h4>
                                <p class="text-sm leading-relaxed">Kebijakan Mutu adalah dokumen resmi yang memuat arah, komitmen, dan prinsip dasar perguruan tinggi dalam menyelenggarakan penjaminan mutu secara berkelanjutan. Kebijakan mutu menjadi landasan utama dalam penyusunan standar, manual, dan seluruh dokumen SPMI, serta acuan bagi seluruh sivitas akademika dalam menjalankan budaya mutu.</p>
                            </div>

                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="text-emerald-600 text-2xl font-bold"><i class="fa-solid fa-list-check"></i></div>
                                <h4 class="text-lg font-bold text-slate-900">Standar Mutu</h4>
                                <p class="text-sm leading-relaxed">Standar Mutu adalah dokumen mutu berisi kriteria dan ukuran minimal yang harus dipenuhi dalam penyelenggaraan seluruh kegiatan tridharma perguruan tinggi serta tata kelola institusi. Standar mutu disusun mengacu pada Standar Nasional Pendidikan Tinggi (SN-Dikti) dan dikembangkan sesuai dengan visi, misi, serta kebutuhan institusi.</p>
                            </div>

                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="text-indigo-600 text-2xl font-bold"><i class="fa-solid fa-compass"></i></div>
                                <h4 class="text-lg font-bold text-slate-900">Manual Mutu</h4>
                                <p class="text-sm leading-relaxed">Manual Mutu merupakan dokumen yang menjelaskan sistem, mekanisme, struktur, dan prosedur pelaksanaan Sistem Penjaminan Mutu Internal. Manual mutu menjadi pedoman operasional bagi seluruh unit kerja dalam menerapkan penjaminan mutu secara terintegrasi dan berkelanjutan.</p>
                            </div>

                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="text-amber-600 text-2xl font-bold"><i class="fa-solid fa-arrows-spin"></i></div>
                                <h4 class="text-lg font-bold text-slate-900">Siklus PPEPP</h4>
                                <p class="text-sm leading-relaxed">Siklus PPEPP adalah tahapan pelaksanaan penjaminan mutu yang terdiri dari Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan standar mutu. Siklus ini bertujuan memastikan bahwa standar mutu tidak hanya ditetapkan, tetapi juga dilaksanakan, dievaluasi, dikendalikan, dan terus ditingkatkan secara berkelanjutan.</p>
                            </div>

                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="text-rose-600 text-2xl font-bold"><i class="fa-solid fa-file-lines"></i></div>
                                <h4 class="text-lg font-bold text-slate-900">SOP (Standar Operasional Prosedur)</h4>
                                <p class="text-sm leading-relaxed">Standar Operasional Prosedur (SOP) adalah dokumen yang memuat langkah-langkah kerja baku, sistematis, dan terukur dalam pelaksanaan suatu kegiatan atau proses. SOP bertujuan untuk menjamin konsistensi, efisiensi, efektivitas, serta kualitas pelaksanaan kegiatan di seluruh unit kerja.</p>
                            </div>

                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="text-teal-600 text-2xl font-bold"><i class="fa-solid fa-table-list"></i></div>
                                <h4 class="text-lg font-bold text-slate-900">Formulir Mutu</h4>
                                <p class="text-sm leading-relaxed">Formulir adalah instrumen tertulis yang digunakan untuk mencatat, mendokumentasikan, dan memverifikasi pelaksanaan kegiatan sesuai standar dan SOP. Formulir berfungsi sebagai alat bukti objektif dalam proses monitoring, evaluasi, audit mutu, serta pengambilan keputusan.</p>
                            </div>
                        </div>

                        <div class="mt-8 p-6 bg-gradient-to-r from-sky-900 to-blue-900 rounded-2xl text-white flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div>
                                <h4 class="text-lg font-bold">Unduh Seluruh Dokumen Mutu di Google Drive</h4>
                                <p class="text-sm text-sky-200">Akses repositori resmi dokumen kebijakan, standar, SOP, dan formulir mutu LPMI.</p>
                            </div>
                            <a href="https://drive.google.com/drive/folders/1-7mDzdzcnp3O5LbvQqCowtHqLetXU84O?usp=drive_link" target="_blank" class="px-5 py-2.5 rounded-xl bg-white text-sky-900 font-bold text-sm hover:bg-sky-100 transition whitespace-nowrap shadow">
                                <i class="fa-brands fa-google-drive mr-2"></i> Buka Google Drive
                            </a>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'halaman-ami',
                'title' => 'Kebijakan Audit Mutu Internal (AMI) & Auditor',
                'banner_image' => null,
                'order_index' => 6,
                'is_published' => true,
                'content' => '
                    <div class="space-y-10">
                        <!-- 1. Kebijakan AMI Card -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400">Penjaminan Mutu Internal</span>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Kebijakan AMI</h3>
                                </div>
                            </div>
                            <p class="text-sm sm:text-base text-slate-700 dark:text-slate-300 leading-relaxed">
                                Kegiatan Audit Mutu Internal (AMI) merupakan bagian penting dari pelaksanaan sistem penjaminan mutu internal di STIKes Panti Waluya Malang yang bertujuan untuk menjamin dan mendorong peningkatan mutu secara berkelanjutan di lingkungan perguruan tinggi. Pelaksanaan AMI dilakukan secara berkelanjutan setiap satu tahun sekali secara terencana dan independen oleh auditor internal yang kompeten.
                            </p>
                        </div>

                        <!-- 2. Auditor Info & Table Card -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-user-check"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Kualifikasi Auditor Resmi</span>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Auditor Mutu Internal</h3>
                                </div>
                            </div>
                            <p class="text-sm sm:text-base text-slate-700 dark:text-slate-300 leading-relaxed">
                                Auditor AMI STIKes Panti Waluya malang adalah personel yang telah ditugaskan secara resmi oleh institusi untuk melaksanakan audit mutu internal di STIKes Panti Waluya Malang dengan kualifikasi yang telah diakui oleh LLDIKTI melalui kegiatan pelatihan dan memperoleh sertifikat sebagai Auditor AMI.
                            </p>

                            <!-- Tabel Daftar Auditor -->
                            <div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left text-xs sm:text-sm">
                                        <thead class="bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 border-b border-slate-200 dark:border-slate-700 uppercase tracking-wider text-[11px] font-bold">
                                            <tr>
                                                <th scope="col" class="px-4 py-3.5 text-center w-16">No</th>
                                                <th scope="col" class="px-6 py-3.5">Nama Auditor (Inisial)</th>
                                                <th scope="col" class="px-6 py-3.5 text-center w-48">Sertifikat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 font-medium">
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">1</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Wisoedhanie Widi Anugrahati, S.K.M., M.Kes. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(WWA)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1lPPyF-KPlH-ioYtU0RrmardkwFlRJAwL/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">2</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Ns. Oda Debora, S.Kep. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(OD)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1XqX29AQaPM6SGWOr9__rTW8sm1petwQX/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">3</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Ns. Febrina Secsaria Handini, M.Kep. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(FSH)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/10RsN97EPmAKQ0EWuOMMvf2AtxTT9EFmZ/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">4</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Venny Kurnia Andika S.Si., M.Biotech <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(VKA)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1ZYx2WPSOxpWA6MipwObclYbXLVAL1j70/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">5</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Ns. Narita Diatanti, S.Kep. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(ND)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1Smf3yrTfdWaigyKl-u03Qejp_5WMdZx1/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">6</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Atanasius Omega Dewantara, S.E <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(AOD)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1RimIVHpBpibbTpzPLuZr-8kY6QB9Khyk/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">7</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Wibowo, S.Kep., Ns., M.Biomed <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(W)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1voLOv7RenobVdXRHQyk6MweehVQKm2lS/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Alur AMI Card -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-diagram-project"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Diagram Prosedur</span>
                                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Alur AMI</h3>
                                    </div>
                                </div>
                                <a href="/storage/ami/alur-ami.jpeg" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                                    <i class="fa-solid fa-expand text-slate-500"></i>
                                    <span>Lihat Ukuran Penuh</span>
                                </a>
                            </div>
                            <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950">
                                <a href="/storage/ami/alur-ami.jpeg" target="_blank" title="Klik untuk membuka diagram resolusi tinggi">
                                    <img src="/storage/ami/alur-ami.jpeg" alt="Bagan Alur Audit Mutu Internal (AMI) STIKES Panti Waluya" class="w-full h-auto object-contain hover:scale-[1.01] transition duration-300" loading="lazy">
                                </a>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 italic text-center">
                                * Klik pada gambar alur untuk melihat diagram resolusi penuh dalam tab baru.
                            </p>
                        </div>

                        <!-- 4. Laporan Hasil Audit Mutu per Program Studi -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Pusat Arsip Laporan</span>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Laporan Hasil Audit Mutu per Program Studi</h3>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <a href="https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link" target="_blank" rel="noopener noreferrer" class="p-5 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition text-center space-y-3 block group">
                                    <div class="text-3xl text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition transform"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div>
                                        <h5 class="font-bold text-slate-900 dark:text-white text-sm">AMI S1 Keperawatan</h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Hasil Audit Mutu</p>
                                    </div>
                                    <span class="inline-flex items-center text-[11px] font-bold text-emerald-600 dark:text-emerald-400 group-hover:underline">Buka Google Drive <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i></span>
                                </a>

                                <a href="https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link" target="_blank" rel="noopener noreferrer" class="p-5 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow-md transition text-center space-y-3 block group">
                                    <div class="text-3xl text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition transform"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div>
                                        <h5 class="font-bold text-slate-900 dark:text-white text-sm">AMI S1 Farmasi</h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Hasil Audit Mutu</p>
                                    </div>
                                    <span class="inline-flex items-center text-[11px] font-bold text-indigo-600 dark:text-indigo-400 group-hover:underline">Buka Google Drive <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i></span>
                                </a>

                                <a href="https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link" target="_blank" rel="noopener noreferrer" class="p-5 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-amber-500 dark:hover:border-amber-500 hover:shadow-md transition text-center space-y-3 block group">
                                    <div class="text-3xl text-amber-600 dark:text-amber-400 group-hover:scale-110 transition transform"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div>
                                        <h5 class="font-bold text-slate-900 dark:text-white text-sm">AMI D4 MIK</h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Hasil Audit Mutu</p>
                                    </div>
                                    <span class="inline-flex items-center text-[11px] font-bold text-amber-600 dark:text-amber-400 group-hover:underline">Buka Google Drive <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'kebijakan-ami',
                'title' => 'Kebijakan Audit Mutu Internal (AMI) & Auditor',
                'banner_image' => null,
                'order_index' => 6,
                'is_published' => true,
                'content' => '
                    <div class="space-y-10">
                        <!-- 1. Kebijakan AMI Card -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400">Penjaminan Mutu Internal</span>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Kebijakan AMI</h3>
                                </div>
                            </div>
                            <p class="text-sm sm:text-base text-slate-700 dark:text-slate-300 leading-relaxed">
                                Kegiatan Audit Mutu Internal (AMI) merupakan bagian penting dari pelaksanaan sistem penjaminan mutu internal di STIKes Panti Waluya Malang yang bertujuan untuk menjamin dan mendorong peningkatan mutu secara berkelanjutan di lingkungan perguruan tinggi. Pelaksanaan AMI dilakukan secara berkelanjutan setiap satu tahun sekali secara terencana dan independen oleh auditor internal yang kompeten.
                            </p>
                        </div>

                        <!-- 2. Auditor Info & Table Card -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-user-check"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Kualifikasi Auditor Resmi</span>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Auditor Mutu Internal</h3>
                                </div>
                            </div>
                            <p class="text-sm sm:text-base text-slate-700 dark:text-slate-300 leading-relaxed">
                                Auditor AMI STIKes Panti Waluya malang adalah personel yang telah ditugaskan secara resmi oleh institusi untuk melaksanakan audit mutu internal di STIKes Panti Waluya Malang dengan kualifikasi yang telah diakui oleh LLDIKTI melalui kegiatan pelatihan dan memperoleh sertifikat sebagai Auditor AMI.
                            </p>

                            <!-- Tabel Daftar Auditor -->
                            <div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left text-xs sm:text-sm">
                                        <thead class="bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 border-b border-slate-200 dark:border-slate-700 uppercase tracking-wider text-[11px] font-bold">
                                            <tr>
                                                <th scope="col" class="px-4 py-3.5 text-center w-16">No</th>
                                                <th scope="col" class="px-6 py-3.5">Nama Auditor (Inisial)</th>
                                                <th scope="col" class="px-6 py-3.5 text-center w-48">Sertifikat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 font-medium">
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">1</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Wisoedhanie Widi Anugrahati, S.K.M., M.Kes. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(WWA)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1lPPyF-KPlH-ioYtU0RrmardkwFlRJAwL/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">2</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Ns. Oda Debora, S.Kep. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(OD)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1XqX29AQaPM6SGWOr9__rTW8sm1petwQX/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">3</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Ns. Febrina Secsaria Handini, M.Kep. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(FSH)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/10RsN97EPmAKQ0EWuOMMvf2AtxTT9EFmZ/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">4</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Venny Kurnia Andika S.Si., M.Biotech <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(VKA)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1ZYx2WPSOxpWA6MipwObclYbXLVAL1j70/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">5</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Ns. Narita Diatanti, S.Kep. <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(ND)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1Smf3yrTfdWaigyKl-u03Qejp_5WMdZx1/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">6</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Atanasius Omega Dewantara, S.E <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(AOD)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1RimIVHpBpibbTpzPLuZr-8kY6QB9Khyk/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                                <td class="px-4 py-3.5 text-center font-bold text-slate-500 dark:text-slate-400">7</td>
                                                <td class="px-6 py-3.5 text-slate-900 dark:text-white font-semibold">
                                                    Wibowo, S.Kep., Ns., M.Biomed <span class="text-xs text-sky-600 dark:text-sky-400 font-bold ml-1">(W)</span>
                                                </td>
                                                <td class="px-6 py-3.5 text-center">
                                                    <a href="https://drive.google.com/file/d/1voLOv7RenobVdXRHQyk6MweehVQKm2lS/view?usp=drive_link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-50 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border border-sky-200 dark:border-sky-800 hover:bg-sky-100 dark:hover:bg-sky-900 transition shadow-sm">
                                                        <i class="fa-solid fa-certificate text-sky-500"></i>
                                                        <span>Sertifikat Auditor</span>
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5 opacity-70"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Alur AMI Card -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-diagram-project"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Diagram Prosedur</span>
                                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Alur AMI</h3>
                                    </div>
                                </div>
                                <a href="/storage/ami/alur-ami.jpeg" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                                    <i class="fa-solid fa-expand text-slate-500"></i>
                                    <span>Lihat Ukuran Penuh</span>
                                </a>
                            </div>
                            <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950">
                                <a href="/storage/ami/alur-ami.jpeg" target="_blank" title="Klik untuk membuka diagram resolusi tinggi">
                                    <img src="/storage/ami/alur-ami.jpeg" alt="Bagan Alur Audit Mutu Internal (AMI) STIKES Panti Waluya" class="w-full h-auto object-contain hover:scale-[1.01] transition duration-300" loading="lazy">
                                </a>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 italic text-center">
                                * Klik pada gambar alur untuk melihat diagram resolusi penuh dalam tab baru.
                            </p>
                        </div>

                        <!-- 4. Laporan Hasil Audit Mutu per Program Studi -->
                        <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-lg">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Pusat Arsip Laporan</span>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">Laporan Hasil Audit Mutu per Program Studi</h3>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <a href="https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link" target="_blank" rel="noopener noreferrer" class="p-5 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition text-center space-y-3 block group">
                                    <div class="text-3xl text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition transform"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div>
                                        <h5 class="font-bold text-slate-900 dark:text-white text-sm">AMI S1 Keperawatan</h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Hasil Audit Mutu</p>
                                    </div>
                                    <span class="inline-flex items-center text-[11px] font-bold text-emerald-600 dark:text-emerald-400 group-hover:underline">Buka Google Drive <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i></span>
                                </a>

                                <a href="https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link" target="_blank" rel="noopener noreferrer" class="p-5 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow-md transition text-center space-y-3 block group">
                                    <div class="text-3xl text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition transform"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div>
                                        <h5 class="font-bold text-slate-900 dark:text-white text-sm">AMI S1 Farmasi</h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Hasil Audit Mutu</p>
                                    </div>
                                    <span class="inline-flex items-center text-[11px] font-bold text-indigo-600 dark:text-indigo-400 group-hover:underline">Buka Google Drive <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i></span>
                                </a>

                                <a href="https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link" target="_blank" rel="noopener noreferrer" class="p-5 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-amber-500 dark:hover:border-amber-500 hover:shadow-md transition text-center space-y-3 block group">
                                    <div class="text-3xl text-amber-600 dark:text-amber-400 group-hover:scale-110 transition transform"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div>
                                        <h5 class="font-bold text-slate-900 dark:text-white text-sm">AMI D4 MIK</h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Laporan Hasil Audit Mutu</p>
                                    </div>
                                    <span class="inline-flex items-center text-[11px] font-bold text-amber-600 dark:text-amber-400 group-hover:underline">Buka Google Drive <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'akred-regulasi',
                'title' => 'Akreditasi & Regulasi',
                'banner_image' => null,
                'order_index' => 7,
                'is_published' => true,
                'content' => '
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4 border-b pb-2">Sertifikat Akreditasi Institusi & Program Studi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm space-y-2">
                                    <img src="/storage/akreditasi/sertifikat-akreditasi-ban-pt-2025.jpg" alt="Sertifikat Akreditasi BAN-PT" class="w-full h-56 object-cover rounded-lg border">
                                    <h5 class="font-bold text-slate-900 text-sm pt-2">Sertifikat Akreditasi STIKES Panti Waluya Malang</h5>
                                    <p class="text-xs text-slate-500">Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT)</p>
                                </div>

                                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm space-y-2">
                                    <img src="/storage/akreditasi/sertifikat-ners.png" alt="Sertifikat Akreditasi Ners" class="w-full h-56 object-cover rounded-lg border">
                                    <h5 class="font-bold text-slate-900 text-sm pt-2">Sertifikat Akreditasi Program Studi Profesi Ners</h5>
                                    <p class="text-xs text-slate-500">LAM-PTKes</p>
                                </div>

                                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm space-y-2">
                                    <img src="/storage/akreditasi/sertifikat-farmasi.png" alt="Sertifikat Akreditasi S1 Farmasi" class="w-full h-56 object-cover rounded-lg border">
                                    <h5 class="font-bold text-slate-900 text-sm pt-2">Sertifikat Akreditasi Program Studi S1 Farmasi</h5>
                                    <p class="text-xs text-slate-500">LAM-PTKes</p>
                                </div>

                                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm space-y-2">
                                    <img src="/storage/akreditasi/sertifikat-mik.png" alt="Sertifikat Akreditasi DIV MIK" class="w-full h-56 object-cover rounded-lg border">
                                    <h5 class="font-bold text-slate-900 text-sm pt-2">Sertifikat Akreditasi Program Studi DIV Manajemen Informasi Kesehatan</h5>
                                    <p class="text-xs text-slate-500">LAM-PTKes</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
                            <h3 class="text-lg font-bold text-slate-900 mb-3">Regulasi Penjaminan Mutu</h3>
                            <a href="https://drive.google.com/file/d/1-A6PSNdCXQHzeZtv6m5NBZertxHx0ZOb/view?usp=sharing" target="_blank" class="inline-flex items-center text-sky-700 font-bold hover:underline">
                                <i class="fa-solid fa-file-pdf mr-2 text-red-600 text-lg"></i> Permendiktisaintek No 39 Tahun 2025 tentang Penjaminan Mutu Pendidikan Tinggi
                            </a>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'laporansurveykepuasan-2',
                'title' => 'Laporan Survei Kepuasan',
                'banner_image' => '/storage/carousels/beranda-web-1.jpg',
                'order_index' => 8,
                'is_published' => true,
                'content' => '
                    <div class="space-y-6">
                        <p class="text-slate-700 leading-relaxed">
                            LPMI menyelenggarakan survei kepuasan civitas akademika dan mitra secara berkala untuk mengevaluasi kinerja layanan institusi dan mendukung perbaikan berkelanjutan.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="https://forms.gle/34r6wctMrXQpfA45A" target="_blank" class="p-5 bg-white rounded-xl border border-slate-200 hover:border-sky-500 transition shadow-sm block">
                                <div class="text-sky-600 text-2xl mb-2"><i class="fa-solid fa-user-tie"></i></div>
                                <h5 class="font-bold text-slate-900 text-sm">Survei Kepuasan Dosen</h5>
                                <p class="text-xs text-slate-500">Isi kuesioner layanan dosen</p>
                            </a>

                            <a href="https://forms.gle/WmXDkgTMayNVpz6L6" target="_blank" class="p-5 bg-white rounded-xl border border-slate-200 hover:border-sky-500 transition shadow-sm block">
                                <div class="text-emerald-600 text-2xl mb-2"><i class="fa-solid fa-id-card-clip"></i></div>
                                <h5 class="font-bold text-slate-900 text-sm">Survei Kepuasan Tendik</h5>
                                <p class="text-xs text-slate-500">Isi kuesioner tenaga kependidikan</p>
                            </a>

                            <a href="/halaman/kuesioner-mahasiswa" class="p-5 bg-white rounded-xl border border-slate-200 hover:border-sky-500 transition shadow-sm block">
                                <div class="text-indigo-600 text-2xl mb-2"><i class="fa-solid fa-graduation-cap"></i></div>
                                <h5 class="font-bold text-slate-900 text-sm">Survei Kepuasan Mahasiswa</h5>
                                <p class="text-xs text-slate-500">Isi kuesioner kepuasan mahasiswa</p>
                            </a>

                            <a href="https://drive.google.com/drive/folders/1IQ3r6WrJU3nIOpVLrHLzXzjP-_2NcVSH?usp=drive_link" target="_blank" class="p-5 bg-white rounded-xl border border-slate-200 hover:border-sky-500 transition shadow-sm block">
                                <div class="text-amber-600 text-2xl mb-2"><i class="fa-solid fa-folder-open"></i></div>
                                <h5 class="font-bold text-slate-900 text-sm">Laporan Hasil Survei (Drive)</h5>
                                <p class="text-xs text-slate-500">Unduh arsip laporan tahunan survei</p>
                            </a>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'kuesioner-mahasiswa',
                'title' => 'Kuesioner Mahasiswa',
                'banner_image' => '/storage/carousels/beranda-web-2.jpg',
                'order_index' => 9,
                'is_published' => true,
                'content' => '
                    <div class="space-y-6">
                        <div class="p-6 bg-sky-50 rounded-2xl border border-sky-200">
                            <h4 class="font-bold text-sky-950 mb-2">Penilaian Terhadap STIKes Panti Waluya Malang</h4>
                            <p class="text-sm text-sky-800 leading-relaxed">
                                Dimohon mahasiswa/i aktif STIKES Panti Waluya Malang untuk mengisi kuesioner kepuasan pelayanan guna meningkatkan mutu pembelajaran, sarana prasarana, dan administrasi kampus.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="https://s.surveyplanet.com/X1R6hKKKW" target="_blank" class="p-5 bg-white rounded-xl border border-slate-200 hover:border-sky-500 transition shadow-sm flex items-center space-x-3">
                                <i class="fa-solid fa-clipboard-question text-sky-600 text-2xl"></i>
                                <div>
                                    <h5 class="font-bold text-slate-900 text-sm">Kuesioner Kepuasan Layanan Mahasiswa</h5>
                                    <p class="text-xs text-slate-500">Buka SurveyPlanet</p>
                                </div>
                            </a>
                        </div>
                    </div>
                ',
            ],
            [
                'slug' => 'kuesioner-dosen',
                'title' => 'Kuesioner Dosen',
                'banner_image' => '/storage/carousels/beranda-web-3.jpg',
                'order_index' => 10,
                'is_published' => true,
                'content' => '
                    <div class="space-y-6">
                        <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-200">
                            <h4 class="font-bold text-emerald-950 mb-2">Penilaian Layanan Civitas Dosen</h4>
                            <p class="text-sm text-emerald-800 leading-relaxed">
                                Kuesioner ini bertujuan untuk mengukur tingkat kepuasan dosen terhadap pengelolaan institusi, sarana laboratorium, dan dukungan tridharma perguruan tinggi.
                            </p>
                        </div>
                        <a href="https://forms.gle/34r6wctMrXQpfA45A" target="_blank" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition shadow">
                            <i class="fa-solid fa-pen-to-square mr-2"></i> Isi Kuesioner Dosen Sekarang
                        </a>
                    </div>
                ',
            ],
            [
                'slug' => 'home-2',
                'title' => 'Kuesioner Pembimbing Laboratorium',
                'banner_image' => '/storage/carousels/beranda-web-4.jpg',
                'order_index' => 11,
                'is_published' => true,
                'content' => '
                    <div class="space-y-6">
                        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
                            <h4 class="font-bold text-slate-900 mb-2">Formulir Evaluasi Pendampingan Laboratorium</h4>
                            <p class="text-sm text-slate-700 leading-relaxed">
                                Selamat datang para pendamping laboratorium, dimohon untuk mengisi form evaluasi berikut sebagai masukan pelaksanaan praktikum:
                            </p>
                            <div class="mt-4 flex flex-wrap gap-4">
                                <a href="https://s.surveyplanet.com/2f9txvOoO" target="_blank" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl text-xs hover:bg-blue-700 transition">
                                    Evaluasi Diri Saya
                                </a>
                                <a href="https://s.surveyplanet.com/_Nke140x6" target="_blank" class="px-5 py-2.5 bg-sky-600 text-white font-bold rounded-xl text-xs hover:bg-sky-700 transition">
                                    Evaluasi Mahasiswa Saya
                                </a>
                            </div>
                        </div>
                    </div>
                ',
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 12. Hierarchical Navigation Menus (100% Matched to spmi.stikespantiwaluya.ac.id)
        NavMenu::truncate();

        // 1. Beranda
        NavMenu::create([
            'label' => 'Beranda',
            'url' => '/',
            'target' => '_self',
            'order_index' => 1,
            'is_active' => true,
            'parent_id' => null,
        ]);

        // 2. Profil LPMI (Dropdown)
        $menuProfil = NavMenu::create([
            'label' => 'Profil LPMI',
            'url' => '#',
            'target' => '_self',
            'order_index' => 2,
            'is_active' => true,
            'parent_id' => null,
        ]);

        NavMenu::create(['label' => 'LPMI SPWM', 'url' => '/halaman/profil-lpmi', 'target' => '_self', 'order_index' => 1, 'is_active' => true, 'parent_id' => $menuProfil->id]);
        NavMenu::create(['label' => 'Visi & Misi', 'url' => '/halaman/visi-misi', 'target' => '_self', 'order_index' => 2, 'is_active' => true, 'parent_id' => $menuProfil->id]);
        NavMenu::create(['label' => 'Struktur Organisasi', 'url' => '/halaman/struktur-organisasi', 'target' => '_self', 'order_index' => 3, 'is_active' => true, 'parent_id' => $menuProfil->id]);
        NavMenu::create(['label' => 'Tugas & Fungsi', 'url' => '/halaman/tugas-fungsi', 'target' => '_self', 'order_index' => 4, 'is_active' => true, 'parent_id' => $menuProfil->id]);

        // 3. Dokumen SPMI
        NavMenu::create([
            'label' => 'Dokumen SPMI',
            'url' => '/halaman/dokumen-spmi',
            'target' => '_self',
            'order_index' => 3,
            'is_active' => true,
            'parent_id' => null,
        ]);

        // 4. AMI
        NavMenu::create([
            'label' => 'AMI',
            'url' => '/halaman/halaman-ami',
            'target' => '_self',
            'order_index' => 4,
            'is_active' => true,
            'parent_id' => null,
        ]);

        // 5. Layanan (Dropdown)
        $menuLayanan = NavMenu::create([
            'label' => 'Layanan',
            'url' => '#',
            'target' => '_self',
            'order_index' => 5,
            'is_active' => true,
            'parent_id' => null,
        ]);

        NavMenu::create(['label' => 'Pengaduan Mutu', 'url' => 'https://forms.gle/Dy9w93G3cTWnuaFL7', 'target' => '_blank', 'order_index' => 1, 'is_active' => true, 'parent_id' => $menuLayanan->id]);
        NavMenu::create(['label' => 'Pengajuan Dokumen Mutu', 'url' => 'https://forms.gle/xgxqBtrso39iddj16', 'target' => '_blank', 'order_index' => 2, 'is_active' => true, 'parent_id' => $menuLayanan->id]);
        NavMenu::create(['label' => 'Semua Layanan Mutu', 'url' => '/layanan', 'target' => '_self', 'order_index' => 3, 'is_active' => true, 'parent_id' => $menuLayanan->id]);

        // 6. Survey Kepuasan (Dropdown)
        $menuSurvey = NavMenu::create([
            'label' => 'Survey Kepuasan',
            'url' => '#',
            'target' => '_self',
            'order_index' => 6,
            'is_active' => true,
            'parent_id' => null,
        ]);

        NavMenu::create(['label' => 'Survey Kepuasan Dosen', 'url' => 'https://forms.gle/34r6wctMrXQpfA45A', 'target' => '_blank', 'order_index' => 1, 'is_active' => true, 'parent_id' => $menuSurvey->id]);
        NavMenu::create(['label' => 'Survey Kepuasan Tendik', 'url' => 'https://forms.gle/WmXDkgTMayNVpz6L6', 'target' => '_blank', 'order_index' => 2, 'is_active' => true, 'parent_id' => $menuSurvey->id]);
        NavMenu::create(['label' => 'Survey Kepuasan Mahasiswa', 'url' => '/halaman/kuesioner-mahasiswa', 'target' => '_self', 'order_index' => 3, 'is_active' => true, 'parent_id' => $menuSurvey->id]);
        NavMenu::create(['label' => 'Laporan Hasil Survei', 'url' => '/halaman/laporansurveykepuasan-2', 'target' => '_self', 'order_index' => 4, 'is_active' => true, 'parent_id' => $menuSurvey->id]);

        // 7. Unduhan (Dropdown)
        $menuUnduhan = NavMenu::create([
            'label' => 'Unduhan',
            'url' => '#',
            'target' => '_self',
            'order_index' => 7,
            'is_active' => true,
            'parent_id' => null,
        ]);

        NavMenu::create(['label' => 'Dokumen Mutu (Folder Drive)', 'url' => 'https://drive.google.com/drive/folders/1-7mDzdzcnp3O5LbvQqCowtHqLetXU84O?usp=drive_link', 'target' => '_blank', 'order_index' => 1, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Renstra Institusi', 'url' => 'https://drive.google.com/file/d/1YPc2CRsVJoLWqyQG4xeZ01kc9-X35Kzv/view?usp=drive_link', 'target' => '_blank', 'order_index' => 2, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Renop Institusi', 'url' => 'https://drive.google.com/drive/folders/1ycvGF9eyfy1cYTTS-589HHqIlcsL5yQg?usp=drive_link', 'target' => '_blank', 'order_index' => 3, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Kebijakan SPMI', 'url' => 'https://drive.google.com/file/d/18RCOMR2QteF4gctv40__g3SZp-BCw1I8/view?usp=drive_link', 'target' => '_blank', 'order_index' => 4, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Standar SNDIKTI & SNPT', 'url' => 'https://drive.google.com/drive/folders/1Sv0ZO3qRocBa6yeaNBvdnxdQNgkxQmGy?usp=drive_link', 'target' => '_blank', 'order_index' => 5, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'SOP Institusi', 'url' => 'https://drive.google.com/drive/folders/1QBryp28QyWJkWlYYti9qwmFN84mHCfnc?usp=drive_link', 'target' => '_blank', 'order_index' => 6, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Formulir Mutu', 'url' => 'https://drive.google.com/drive/folders/17VIWEdXyLRdztCxpCwJcd8kYUYad688q?usp=drive_link', 'target' => '_blank', 'order_index' => 7, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Laporan AMI', 'url' => 'https://drive.google.com/drive/folders/12IkJCQb32-Vc8wV3BxxooY-jjQs3TVGo?usp=drive_link', 'target' => '_blank', 'order_index' => 8, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Laporan MONEV', 'url' => 'https://drive.google.com/drive/folders/1s8QOMcfcOGr0HlJJ1SIqDd7YHEHPyCvG?usp=drive_link', 'target' => '_blank', 'order_index' => 9, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Laporan RTM', 'url' => 'https://drive.google.com/drive/folders/14-mFE32BRvJ3q3cHOQ-8OqrXyn75XHdQ?usp=drive_link', 'target' => '_blank', 'order_index' => 10, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);
        NavMenu::create(['label' => 'Pusat Unduhan Lengkap', 'url' => '/unduhan', 'target' => '_self', 'order_index' => 11, 'is_active' => true, 'parent_id' => $menuUnduhan->id]);

        // 8. Akreditasi & Regulasi
        NavMenu::create([
            'label' => 'Akreditasi & Regulasi',
            'url' => '/halaman/akred-regulasi',
            'target' => '_self',
            'order_index' => 8,
            'is_active' => true,
            'parent_id' => null,
        ]);

        // 9. Kontak
        NavMenu::create([
            'label' => 'Kontak',
            'url' => '/kontak',
            'target' => '_self',
            'order_index' => 9,
            'is_active' => true,
            'parent_id' => null,
        ]);
    }
}
