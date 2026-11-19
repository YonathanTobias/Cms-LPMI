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
     * Seed the application's database for Kemahasiswaan & Belmawa.
     */
    public function run(): void
    {
        // 1. Create Super Admin and News Admin
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
            ['email' => 'kemahasiswaan@pantiwaluya.ac.id'],
            [
                'name' => 'Super Admin Kemahasiswaan',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Fallback email alias
        User::updateOrCreate(
            ['email' => 'divisi@pantiwaluya.ac.id'],
            [
                'name' => 'Admin Divisi Kemahasiswaan',
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

        $newsAdmin = User::updateOrCreate(
            ['email' => 'berita@pantiwaluya.ac.id'],
            [
                'name' => 'Admin (Upload Berita Kemahasiswaan)',
                'role' => 'admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Kemahasiswaan & Belmawa Division Settings
        $defaultSettings = [
            // Identitas Divisi
            'division_name' => 'Bagian Pembelajaran, Kemahasiswaan, dan Alumni (Belmawa)',
            'division_short_name' => 'Kemahasiswaan STIKES Panti Waluya',
            'division_acronym' => 'BELMAWA',
            'division_tagline' => 'Membina Prestasi, Karakter Unggul, dan Karir Gemilang Mahasiswa',
            'parent_institution' => 'STIKES Panti Waluya Malang',
            'division_icon' => 'fa-solid fa-user-graduate',
            
            // Visual & Branding
            'theme_primary_color' => '#0284c7', // Sky-600
            'theme_secondary_color' => '#0369a1', // Sky-700
            'theme_accent_color' => '#059669', // Emerald-600
            'logo_url' => '',
            'hero_banner_title' => 'Pusat Prestasi, Kreativitas, & Layanan Kemahasiswaan',
            'hero_banner_subtitle' => 'Mendukung mahasiswa STIKES Panti Waluya Malang berkembang optimal melalui beasiswa, kompetisi nasional, pembinaan organisasi, dan kesiapan karir alumni.',

            // Tentang & Visi Misi
            'about_title' => 'Tentang Bagian Kemahasiswaan & Alumni',
            'about_description' => 'Bagian Kemahasiswaan, Alumni, dan Pusat Karir STIKES Panti Waluya Malang merupakan unit pelaksana yang bertugas merencanakan, melaksanakan, dan mengoordinasikan pembinaan bakat, minat, penalaran ilmiah, kesejahteraan (beasiswa), kepemimpinan ormawa, serta pengembangan karir dan tracer study bagi mahasiswa dan alumni.',
            'vision' => 'Menjadi pusat pembinaan potensi kemahasiswaan dan karir yang unggul, berintegritas, berjiwa humanis, dan berdaya saing nasional maupun internasional pada tahun 2030.',
            'mission' => "1. Mengembangkan potensi penalaran dan kreativitas ilmiah mahasiswa melalui kompetisi Belmawa seperti PKM, Pilmapres, dan P2MW.\n2. Mengoptimalkan program kesejahteraan mahasiswa melalui pengelolaan beasiswa yang transparan, tepat sasaran, dan akuntabel.\n3. Membina organisasi kemahasiswaan (BEM, DPM, HIMA, UKM) agar memiliki kepemimpinan adaptif dan etika profesi kesehatan yang luhur.\n4. Menyiapkan lulusan yang kompeten, berdaya saing, berjiwa kewirausahaan, serta memperkuat jejaring alumni dan fasilitas karir.",
            
            // Kontak & Lokasi
            'contact_email' => 'kemahasiswaan@pantiwaluya.ac.id',
            'contact_phone' => '(0341) 569275',
            'contact_whatsapp' => '6281234567890',
            'enable_whatsapp_floating' => '1',
            'whatsapp_floating_message' => 'Halo Bagian Kemahasiswaan, saya ingin bertanya seputar beasiswa & layanan kemahasiswaan.',
            'contact_room' => 'Gedung Rektorat Lt. 1, Ruang Layanan Kemahasiswaan & Alumni',
            'contact_address' => 'Jl. Yulius Usman No. 62, Kasin, Kec. Klojen, Kota Malang, Jawa Timur 65117',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.213601444588!2d112.62473467499647!3d-7.976868692048386!2m3!1f0!2f0!3f0!3m2!1i1024!2f768!4f13.1!3m3!1m2!1s0x2dd62828b49e1a17%3A0xc3cb73f1d3c01fa9!2sSTIKes%20Panti%20Waluya%20Malang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',

            // Media Sosial
            'social_instagram' => 'https://instagram.com/kemahasiswaan.spwm',
            'social_facebook' => 'https://facebook.com/stikespantiwaluyamalang',
            'social_youtube' => 'https://youtube.com/@stikespantiwaluya',
            'social_website' => 'https://pantiwaluya.ac.id',

            // Statistik Ringkas di Beranda
            'stat_1_number' => '850+',
            'stat_1_label' => 'Penerima Beasiswa',
            'stat_2_number' => '42+',
            'stat_2_label' => 'Prestasi Nasional & Wilayah',
            'stat_3_number' => '14',
            'stat_3_label' => 'Ormawa & UKM Aktif',
            'stat_4_number' => '95%',
            'stat_4_label' => 'Tingkat Serapan Lulusan',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }

        // 3. Categories (Belmawa & Kemahasiswaan)
        $catBeasiswa = Category::updateOrCreate(
            ['slug' => 'beasiswa'],
            ['name' => 'Beasiswa & Kesejahteraan', 'type' => 'post', 'description' => 'Informasi beasiswa KIP Kuliah, beasiswa Yayasan, dan bantuan pendidikan']
        );
        $catPrestasi = Category::updateOrCreate(
            ['slug' => 'prestasi-mahasiswa'],
            ['name' => 'Prestasi & Kompetisi', 'type' => 'post', 'description' => 'Kabar prestasi akademik, kejuaraan minat-bakat, dan kompetisi nasional']
        );
        $catOrmawa = Category::updateOrCreate(
            ['slug' => 'kegiatan-ormawa'],
            ['name' => 'Kegiatan Ormawa & Kampus', 'type' => 'post', 'description' => 'Aktivitas BEM, DPM, Himpunan Mahasiswa Prodi, dan Unit Kegiatan Mahasiswa']
        );
        $catPKM = Category::updateOrCreate(
            ['slug' => 'pkm-kewirausahaan'],
            ['name' => 'PKM & Kewirausahaan (P2MW)', 'type' => 'post', 'description' => 'Program Kreativitas Mahasiswa, inovasi karya cipta, dan pembinaan wirausaha mahasiswa']
        );

        $catDoc1 = Category::updateOrCreate(
            ['slug' => 'panduan-pedoman'],
            ['name' => 'Buku Panduan & Regulasi', 'type' => 'document', 'description' => 'Buku pedoman ormawa, panduan PKM, dan tata tertib kemahasiswaan']
        );
        $catDoc2 = Category::updateOrCreate(
            ['slug' => 'formulir-unduhan'],
            ['name' => 'Formulir & Template Mahasiswa', 'type' => 'document', 'description' => 'Template proposal kegiatan ormawa, form dispensasi lomba, dan format LPJ']
        );

        // 4. Sample Posts (Berita & Pengumuman Kemahasiswaan)
        Post::updateOrCreate(
            ['slug' => 'pembukaan-pendaftaran-program-kreativitas-mahasiswa-pkm-kemendiktisaintek-2025'],
            [
                'title' => 'Sosialisasi & Pendaftaran Program Kreativitas Mahasiswa (PKM) Belmawa 2025',
                'category_id' => $catPKM->id,
                'user_id' => $admin->id,
                'type' => 'pengumuman',
                'summary' => 'Direktorat Belmawa resmi membuka seleksi proposal PKM 8 Bidang & PKM Gagasan Futuristik 2025. Daftarkan tim terbaik Anda!',
                'content' => '<p>Direktorat Pembelajaran dan Kemahasiswaan (Belmawa) Kemendiktisaintek kembali menyelenggarakan <strong>Program Kreativitas Mahasiswa (PKM) Tahun 2025</strong>. Program bergengsi ini dirancang untuk memfasilitasi potensi mahasiswa Indonesia dalam mengkaji, mengembangkan, dan menerapkan ilmu pengetahuan dan teknologi yang telah dipelajarinya di perkuliahan kepada masyarakat luas.</p><p>Bidang PKM yang dibuka meliputi:</p><ul><li><strong>PKM Riset Eksakta & Sosial Humaniora (PKM-RE & PKM-RSH)</strong></li><li><strong>PKM Pengabdian kepada Masyarakat (PKM-PM)</strong></li><li><strong>PKM Penerapan Iptek (PKM-PI)</strong></li><li><strong>PKM Kewirausahaan (PKM-K)</strong></li><li><strong>PKM Karsa Cipta (PKM-KC)</strong></li><li><strong>PKM Karya Inovatif (PKM-KI)</strong></li><li><strong>PKM Gagasan Futuristik Tertulis (PKM-GFT) & Artikel Ilmiah (PKM-AI)</strong></li></ul><p>Bagian Kemahasiswaan STIKES Panti Waluya Malang menyediakan program <em>Coaching Clinic</em>, klinik penulisan proposal bersama reviewer internal, serta <strong>insentif dana stimulan</strong> bagi proposal yang berhasil lolos submit dan didanai nasional. Unggah draf proposal Anda melalui menu layanan kemahasiswaan paling lambat <strong>20 Maret 2025</strong>.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'views_count' => 342,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'mahasiswa-stikes-panti-waluya-raih-juara-1-lomba-karya-tulis-ilmiah-kesehatan-nasional'],
            [
                'title' => 'Membanggakan! Delegasi STIKES Panti Waluya Sabet Juara 1 Lomba Karya Tulis Ilmiah Nasional 2025',
                'category_id' => $catPrestasi->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'Tim mahasiswa prodi Keperawatan berhasil meraih predikat Juara 1 dan Best Presentation berkat inovasi aplikasi pemantau luka pasca bedah.',
                'content' => '<p>Kabar membanggakan kembali dipersembahkan oleh sivitas mahasiswa STIKES Panti Waluya Malang pada ajang <em>National Health Scientific Competition 2025</em> yang diselenggarakan di tingkat nasional. Delegasi kampus yang terdiri dari 3 mahasiswa Keperawatan berhasil menyabet <strong>Juara 1</strong> sekaligus predikat <strong>Best Presentation</strong>.</p><p>Karya ilmiah yang diusung berjudul <em>"Penerapan Model Asuhan Homecare Berbasis Tele-nursing Terintegrasi bagi Pasien Geriatri dengan Komorbiditas Kronis di Daerah Rural"</em>. Inovasi ini dinilai dewan juri sangat aplikatif dan memberikan solusi konkret bagi keterbatasan akses layanan rujukan kesehatan.</p><p>Wakil Ketua Bidang Kemahasiswaan menyampaikan apresiasi setinggi-tingginya kepada para mahasiswa dan dosen pendamping. Kampus memberikan penghargaan berupa sertifikat prestasi, piagam kehormatan, serta beasiswa pembebasan biaya perkuliahan selama 1 semester.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(4),
                'views_count' => 518,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'pendaftaran-beasiswa-kip-kuliah-dan-beasiswa-prestasi-yayasan-semester-ganjil'],
            [
                'title' => 'Pendaftaran Beasiswa KIP Kuliah & Beasiswa Prestasi Yayasan Semester Ganjil Resmi Dibuka',
                'category_id' => $catBeasiswa->id,
                'user_id' => $admin->id,
                'type' => 'pengumuman',
                'summary' => 'Informasi lengkap persyaratan berkas, kuota penerima, dan batas akhir pendaftaran beasiswa mahasiswa aktif.',
                'content' => '<p>Bagian Kemahasiswaan mengumumkan dibukanya penerimaan berkas <strong>Beasiswa KIP Kuliah Merdeka</strong> dan <strong>Beasiswa Prestasi Yayasan Wahana Bhakti Waluyo</strong> untuk mahasiswa aktif semester II hingga semester VI.</p><p>Persyaratan umum meliputi:</p><ol><li>Mahasiswa aktif terdaftar pada pangkalan data pendidikan tinggi (PDDikti).</li><li>Memiliki Indeks Prestasi Kumulatif (IPK) minimal 3.25 untuk beasiswa prestasi akademik.</li><li>Melampirkan Kartu Indonesia Pintar (KIP) / Kartu Keluarga Sejahtera (KKS) / Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan bagi pemohon beasiswa kesejahteraan.</li><li>Surat rekomendasi kelakuan baik dari Ketua Program Studi.</li><li>Tidak sedang menerima beasiswa dari instansi atau lembaga donor lain.</li></ol><p>Seluruh berkas pendaftaran diunggah melalui formulir digital di website resmi Kemahasiswaan paling lambat tanggal <strong>15 April 2025</strong>. Informasi lebih lanjut dapat dikonsultasikan langsung di loket layanan kemahasiswaan Gedung Rektorat Lt. 1.</p>',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'views_count' => 640,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'pelantikan-serentak-pengurus-bem-dpm-dan-hima-periode-2025-2026'],
            [
                'title' => 'Pelantikan Serentak Pengurus BEM, DPM, dan Himpunan Mahasiswa Periode 2025/2026',
                'category_id' => $catOrmawa->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'Serah terima jabatan dan pengukuhan komitmen ormawa dalam mewujudkan kepemimpinan mahasiswa berintegritas.',
                'content' => '<p>Bertempat di Aula Utama STIKES Panti Waluya Malang, Bagian Kemahasiswaan menggelar Upacara Pelantikan Serentak Pengurus Dewan Perwakilan Mahasiswa (DPM), Badan Eksekutif Mahasiswa (BEM), serta Himpunan Mahasiswa Program Studi (HIMA) untuk masa bakti 2025/2026.</p><p>Prosesi pelantikan dipimpin langsung oleh Pimpinan STIKES didampingi jajaran Kepala Bagian Kemahasiswaan dan para dosen pembina. Dalam sambutannya, pimpinan menekankan pentingnya sinergi ormawa dengan visi institusi dalam mencetak tenaga kesehatan yang profesional, beretika, dan tanggap terhadap kebutuhan sosial masyarakat.</p><p>Ketua BEM terpilih menyatakan kesiapan kabinet baru dalam menghadirkan program-program kerja yang adaptif, memperkuat budaya riset mahasiswa, serta menjadi wadah aspirasi yang responsif dan inklusif bagi seluruh mahasiswa.</p>',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'views_count' => 285,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'workshop-kesiapan-karir-dan-rekrutmen-langsung-rumah-sakit-mitra'],
            [
                'title' => 'Pusat Karir Gelar Campus Hiring & Workshop Kesiapan Kerja Bersama Jaringan Rumah Sakit Mitra',
                'category_id' => $catPrestasi->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'Mempersiapkan calon lulusan dengan pembekalan wawancara kerja, CV ATS friendly, dan rekrutmen langsung on-campus.',
                'content' => '<p>Sebagai wujud komitmen mempercepat masa tunggu kerja lulusan (time to work), Unit Pusat Karir di bawah Bagian Kemahasiswaan menyelenggarakan <em>Workshop Kesiapan Karir & On-Campus Recruitment</em>. Acara ini menggandeng sejumlah rumah sakit terkemuka dan fasilitas pelayanan kesehatan mitra strategis institusi.</p><p>Para peserta yang merupakan mahasiswa tingkat akhir dan alumni fresh graduate mendapatkan materi teknik wawancara klinis, etika komunikasi profesional, dan simulasi tes kompetensi. Acara dilanjutkan dengan sesi walk-in interview langsung dari bagian HRD rumah sakit mitra.</p>',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(18),
                'views_count' => 412,
            ]
        );

        // 5. Sample Services (Layanan Kemahasiswaan & Belmawa)
        Service::updateOrCreate(
            ['slug' => 'layanan-pengajuan-beasiswa'],
            [
                'title' => 'Layanan Pendaftaran & Verifikasi Beasiswa',
                'icon' => 'fa-solid fa-graduation-cap',
                'summary' => 'Fasilitasi beasiswa KIP Kuliah Merdeka, Beasiswa Prestasi Yayasan, dan bantuan pendidikan mitra industri.',
                'description' => 'Bagian Kemahasiswaan memberikan pelayanan administrasi menyeluruh bagi mahasiswa yang mengajukan beasiswa, meliputi sosialisasi program, penerimaan dan verifikasi berkas, uji kelayakan, wawancara, hingga pengajuan SK penetapan penerima beasiswa ke Kemendiktisaintek maupun Yayasan.',
                'requirements' => "1. Formulir Permohonan Beasiswa yang telah diisi lengkap\n2. KHS / Transkrip Nilai semester terakhir (IPK min. 3.00)\n3. Salinan Kartu Keluarga (KK) dan KTP Pemohon\n4. Bukti slip penghasilan orang tua atau Surat Keterangan Tidak Mampu (SKTM)\n5. Surat Keterangan Berkelakuan Baik & Bebas Sanksi Akademik dari Prodi",
                'procedure' => "1. Mahasiswa mengunduh dan mengisi formulir pendaftaran beasiswa.\n2. Mengunggah berkas persyaratan digital melalui formulir sistem kemahasiswaan.\n3. Tim kemahasiswaan memverifikasi keabsahan data dan berkas fisik di loket.\n4. Seleksi wawancara dan visitasi bagi pendaftar KIP Kuliah.\n5. Pengumuman resmi penerima dan proses pencairan dana beasiswa.",
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'layanan-surat-rekomendasi-dan-dispensasi-lomba'],
            [
                'title' => 'Surat Tugas Delegasi & Dispensasi Kompetisi Mahasiswa',
                'icon' => 'fa-solid fa-trophy',
                'summary' => 'Penerbitan surat tugas resmi delegasi kejuaraan, dispensasi perkuliahan/praktikum, dan bantuan akomodasi lomba.',
                'description' => 'Memberikan legalitas serta dispensasi izin akademik bagi mahasiswa yang berpartisipasi mewakili institusi dalam kejuaraan ilmiah, kompetisi Belmawa, ajang seni budaya, serta olahraga tingkat daerah, nasional, maupun internasional.',
                'requirements' => "1. Surat permohonan delegasi dari Ketua Tim / Ketua Ormawa / Dosen Pembimbing\n2. Bukti undangan resmi atau Booklet Panduan Lomba dari panitia penyelenggara\n3. Daftar nama mahasiswa, NIM, dan Program Studi\n4. Jadwal rangkaian acara dan tanggal kegiatan yang memerlukan dispensasi",
                'procedure' => "1. Mengajukan surat permohonan ke loket Kemahasiswaan minimal H-7 sebelum hari pelaksanaan lomba.\n2. Verifikasi berkas kelayakan delegasi oleh staf kemahasiswaan.\n3. Penerbitan Surat Tugas Institusi dan Surat Dispensasi Kuliah oleh Wakil Ketua III.\n4. Pengambilan surat resmi dan pelaporan hasil lomba pasca kegiatan.",
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'layanan-surat-keterangan-pendamping-ijazah-skpi'],
            [
                'title' => 'Validasi Rekam Jejak Prestasi & Dokumen SKPI',
                'icon' => 'fa-solid fa-award',
                'summary' => 'Pencatatan poin keaktifan ormawa, sertifikat kompetensi keahlian, dan prestasi mahasiswa untuk dokumen SKPI.',
                'description' => 'Layanan validasi portofolio sertifikat kegiatan kemahasiswaan, kepanitiaan, seminar ilmiah, pelatihan soft skills, dan kejuaraan untuk dicantumkan secara resmi dalam dokumen Surat Keterangan Pendamping Ijazah (SKPI) saat mahasiswa lulus.',
                'requirements' => "1. Salinan sertifikat keikutsertaan / kejuaraan / sertifikasi kompetensi\n2. Formulir Rekapitulasi Poin SKPI yang telah disetujui Dosen Wali\n3. Surat pengantar validasi dari Program Studi",
                'procedure' => "1. Mahasiswa mengunggah scan sertifikat asli ke sistem SKPI.\n2. Validasi keabsahan data oleh verifikator Bagian Kemahasiswaan.\n3. Penghitungan akumulasi poin kredit keaktifan kemahasiswaan.\n4. Penerbitan draf lampiran SKPI resmi bersamaan dengan pencetakan ijazah.",
                'order_index' => 3,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'layanan-pembinaan-ormawa-dan-legalisasi-kegiatan'],
            [
                'title' => 'Asistensi Proposal Ormawa & Izin Kegiatan Kampus',
                'icon' => 'fa-solid fa-users-gear',
                'summary' => 'Bimbingan penyusunan rencana program kerja, pencairan dana stimulan ormawa, dan izin sarana prasarana kampus.',
                'description' => 'Mendampingi BEM, DPM, HIMA, dan UKM dalam menyusun perencanaan program kerja tahunan, memfasilitasi pencairan dana stimulan kemahasiswaan, serta mengurus izin peminjaman aula, laboratorium, dan sarana prasarana institusi.',
                'requirements' => "1. Proposal Kegiatan lengkap bertandatangan Ketua Panitia, Ketua Ormawa, & Dosen Pembina\n2. Rencana Anggaran Biaya (RAB) terperinci sesuai pagu anggaran kampus\n3. Jadwal rundown acara dan form permohonan peminjaman sarana prasarana",
                'procedure' => "1. Penyerahan berkas proposal ke Bagian Kemahasiswaan minimal H-14 sebelum kegiatan.\n2. Asistensi kelayakan program dan telaah anggaran oleh Kasubag Ormawa.\n3. Penerbitan Surat Izin Kegiatan dan disposisi sarpras ke bagian umum.\n4. Penyerahan Laporan Pertanggungjawaban (LPJ) paling lambat H+14 setelah acara.",
                'order_index' => 4,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'layanan-konseling-dan-kesejahteraan-mahasiswa'],
            [
                'title' => 'Pusat Konseling Mahasiswa & Pembinaan Karakter',
                'icon' => 'fa-solid fa-hand-holding-heart',
                'summary' => 'Layanan bimbingan psikologis, adaptasi akademik, penanganan kendala belajar, dan konsultasi karir secara konfidensial.',
                'description' => 'Menyediakan ruang konsultasi yang aman, nyaman, dan terjaga kerahasiaannya bersama dosen konselor profesional untuk membantu mahasiswa mengatasi stres akademik, adaptasi lingkungan kampus, maupun perencanaan masa depan.',
                'requirements' => "1. Kartu Tanda Mahasiswa (KTM) aktif\n2. Mengisi formulir jadwal konsultasi (secara daring atau langsung di loket)",
                'procedure' => "1. Mahasiswa memilih jadwal konseling via formulir online atau loket kemahasiswaan.\n2. Penentuan dosen konselor yang sesuai dengan topik konsultasi.\n3. Sesi tatap muka konsultasi secara privat di Ruang Konseling Kemahasiswaan.\n4. Tindak lanjut pendampingan berkala sesuai kebutuhan mahasiswa.",
                'order_index' => 5,
                'is_active' => true,
            ]
        );

        // 6. Sample Team Members (Bagian Kemahasiswaan & Alumni)
        TeamMember::updateOrCreate(
            ['name' => 'Ns. Fransiska Diana, M.Kep.'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.J',
                'identifier' => 'NIDN. 0714068201',
                'position' => 'Kepala Bagian Kemahasiswaan & Alumni',
                'bio' => 'Dosen Keperawatan Jiwa dengan dedikasi tinggi pada pembinaan karakter mahasiswa, kepemimpinan ormawa, dan konseling akademik.',
                'email' => 'fransiska.diana@pantiwaluya.ac.id',
                'phone' => '081234567801',
                'order_index' => 1,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'apt. Antonius Wicaksono, M.Farm.'],
            [
                'title_degree' => 'M.Farm.',
                'identifier' => 'NIDN. 0729048702',
                'position' => 'Kasubag Penalaran Ilmiah & Prestasi Mahasiswa',
                'bio' => 'Mengoordinasikan pembimbingan Program Kreativitas Mahasiswa (PKM), Pilmapres, P2MW, dan kompetisi inovasi kesehatan nasional.',
                'email' => 'antonius.wicaksono@pantiwaluya.ac.id',
                'phone' => '081234567802',
                'order_index' => 2,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Benedikta Clara, S.Kep., M.Kes.'],
            [
                'title_degree' => 'S.Kep., M.Kes.',
                'identifier' => 'NIDN. 0711089103',
                'position' => 'Kasubag Kesejahteraan Mahasiswa & Ormawa',
                'bio' => 'Bertanggung jawab dalam pengelolaan beasiswa KIP Kuliah, beasiswa kemitraan, pembinaan ormawa (BEM/DPM/HIMA), dan UKM minat-bakat.',
                'email' => 'benedikta.clara@pantiwaluya.ac.id',
                'phone' => '081234567803',
                'order_index' => 3,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Yulius Aditya Pratama, S.Kom.'],
            [
                'title_degree' => 'S.Kom.',
                'identifier' => 'NIP. 202203005',
                'position' => 'Staf Administrasi Kemahasiswaan & Pusat Karir',
                'bio' => 'Pengelola sistem database kemahasiswaan, validasi dokumen SKPI, tracer study alumni, dan administrasi harian loket kemahasiswaan.',
                'email' => 'yulius.aditya@pantiwaluya.ac.id',
                'phone' => '081234567804',
                'order_index' => 4,
            ]
        );

        // 7. Sample Events (Agenda Kegiatan Mahasiswa)
        Event::updateOrCreate(
            ['slug' => 'coaching-clinic-dan-bedah-proposal-pkm-2025'],
            [
                'title' => 'Coaching Clinic & Bedah Proposal PKM 8 Bidang Belmawa 2025',
                'location' => 'Ruang Seminar Lt. 2 Kampus STIKES & Hybrid Zoom',
                'start_date' => now()->addDays(7)->setTime(9, 0),
                'end_date' => now()->addDays(7)->setTime(15, 30),
                'description' => 'Pendampingan intensif bersama reviewer nasional untuk menyempurnakan proposal PKM Riset, Karsa Cipta, dan Pengabdian Masyarakat sebelum diunggah ke portal SIMBelmawa.',
                'registration_link' => 'https://bit.ly/KlinikPKMSPantiwaluya',
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['slug' => 'latihan-keterampilan-manajemen-mahasiswa-lkmm-tingkat-dasar-2025'],
            [
                'title' => 'Latihan Keterampilan Manajemen Mahasiswa (LKMM) Tingkat Dasar 2025',
                'location' => 'Auditorium & Ruang Kelas Terpadu STIKES Panti Waluya',
                'start_date' => now()->addDays(20)->setTime(8, 0),
                'end_date' => now()->addDays(21)->setTime(16, 30),
                'description' => 'Pelatihan kepemimpinan, perumusan gagasan awal, komunikasi efektif, dan tata kelola organisasi wajib bagi seluruh pengurus ormawa baru.',
                'registration_link' => 'https://bit.ly/LKMMDasarSPW2025',
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['slug' => 'pemilihan-mahasiswa-berprestasi-pilmapres-stikes-panti-waluya-2025'],
            [
                'title' => 'Seleksi Pemilihan Mahasiswa Berprestasi (Pilmapres) 2025',
                'location' => 'Auditorium STIKES Panti Waluya Malang',
                'start_date' => now()->addDays(35)->setTime(8, 30),
                'end_date' => now()->addDays(35)->setTime(15, 0),
                'description' => 'Ajang seleksi perwakilan mahasiswa terbaik tingkat institusi untuk maju ke Pilmapres Tingkat Wilayah VII LLDIKTI Jawa Timur.',
                'registration_link' => 'https://bit.ly/PilmapresSPW2025',
                'is_active' => true,
            ]
        );

        // 8. Sample Documents (Pusat Unduhan Kemahasiswaan)
        Document::updateOrCreate(
            ['title' => 'Pedoman Resmi Program Kreativitas Mahasiswa (PKM) Belmawa 2025'],
            [
                'category_id' => $catDoc1->id,
                'file_path' => 'documents/pedoman_resmi_pkm_belmawa_2025.pdf',
                'file_type' => 'PDF',
                'file_size' => '3.8 MB',
                'description' => 'Pedoman umum tata tulis proposal, sistematika anggaran, dan kriteria penilaian PKM 8 Bidang & Gagasan Futuristik Kemendiktisaintek.',
                'downloads_count' => 640,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'Buku Panduan Tata Kelola Organisasi Kemahasiswaan (BEM, DPM, HIMA, UKM)'],
            [
                'category_id' => $catDoc1->id,
                'file_path' => 'documents/buku_panduan_ormawa_stikes_pantiwaluya.pdf',
                'file_type' => 'PDF',
                'file_size' => '2.1 MB',
                'description' => 'Pedoman regulasi ormawa, kode etik mahasiswa, mekanisme pemilihan ketua, dan SOP pengajuan kegiatan.',
                'downloads_count' => 485,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'Template Proposal Kegiatan & Format Laporan Pertanggungjawaban (LPJ)'],
            [
                'category_id' => $catDoc2->id,
                'file_path' => 'documents/template_proposal_dan_lpj_ormawa.docx',
                'file_type' => 'DOCX',
                'file_size' => '540 KB',
                'description' => 'Format standar pengajuan dana stimulan kegiatan mahasiswa serta template pelaporan keuangan dan SPJ kampus.',
                'downloads_count' => 780,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'Formulir Pengajuan Dispensasi Kuliah / Tugas Delegasi Lomba'],
            [
                'category_id' => $catDoc2->id,
                'file_path' => 'documents/form_dispensasi_delegasi_lomba.docx',
                'file_type' => 'DOCX',
                'file_size' => '210 KB',
                'description' => 'Formulir izin dispensasi perkuliahan dan praktikum bagi mahasiswa yang mengikuti kejuaraan mewakili kampus.',
                'downloads_count' => 430,
                'is_published' => true,
            ]
        );

        // 9. Sample Galleries (Galeri Kegiatan Kemahasiswaan)
        Gallery::updateOrCreate(
            ['title' => 'Pelantikan Serentak Pengurus BEM & DPM Periode 2025/2026'],
            [
                'category' => 'Organisasi',
                'image_path' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Upacara serah terima jabatan dan pengukuhan komitmen ormawa di Aula Utama Kampus.',
            ]
        );

        Gallery::updateOrCreate(
            ['title' => 'Coaching Clinic PKM & P2MW Belmawa Bersama Reviewer'],
            [
                'category' => 'Penalaran',
                'image_path' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Sesi bimbingan intensif proposal inovasi mahasiswa bersama dosen pembina.',
            ]
        );

        Gallery::updateOrCreate(
            ['title' => 'Latihan Keterampilan Manajemen Mahasiswa (LKMM) Tingkat Dasar'],
            [
                'category' => 'Kepemimpinan',
                'image_path' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Pelatihan kepemimpinan, komunikasi organisasi, dan outbound pengurus UKM & HIMA.',
            ]
        );

        Gallery::updateOrCreate(
            ['title' => 'Penganugerahan Juara Lomba Karya Tulis Ilmiah Nasional'],
            [
                'category' => 'Prestasi',
                'image_path' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Delegasi mahasiswa meraih tropi Juara 1 dan Best Presentation di ajang kompetisi nasional.',
            ]
        );

        // 10. Sample Carousel Banner Slides (Kemahasiswaan & Belmawa)
        Carousel::updateOrCreate(
            ['title' => 'Pusat Prestasi, Kreativitas, & Layanan Kemahasiswaan'],
            [
                'subtitle' => 'Mewadahi inovasi penalaran ilmiah, kepemimpinan ormawa, dan penyaluran bakat mahasiswa STIKES Panti Waluya Malang.',
                'image_path' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Jelajahi Layanan Mahasiswa',
                'button_link' => '/layanan',
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        Carousel::updateOrCreate(
            ['title' => 'Program Kreativitas Mahasiswa (PKM) Belmawa 2025'],
            [
                'subtitle' => 'Raih pendanaan riset, wujudkan ide inovatif kesehatan, dan ukir prestasi di tingkat nasional bersama kami.',
                'image_path' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Info Seleksi PKM',
                'button_link' => '/berita/pembukaan-pendaftaran-program-kreativitas-mahasiswa-pkm-kemendiktisaintek-2025',
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        Carousel::updateOrCreate(
            ['title' => 'Informasi Beasiswa Pendidikan & Kesejahteraan Mahasiswa'],
            [
                'subtitle' => 'Mendukung kelancaran studi melalui program KIP Kuliah Merdeka, beasiswa prestasi yayasan, dan beasiswa mitra industri.',
                'image_path' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Daftar Beasiswa',
                'button_link' => '/berita/pendaftaran-beasiswa-kip-kuliah-dan-beasiswa-prestasi-yayasan-semester-ganjil',
                'order_index' => 3,
                'is_active' => true,
            ]
        );

        // 11. Navigation Menus
        NavMenu::resetToDefaults();
    }
}
