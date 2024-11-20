<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\LevelUser;
use App\Models\GroupItem;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Stock;
use App\Models\Notifikasi;
use App\Models\Satuan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed LevelUser
        LevelUser::create([
            'id_level_user' => 1,
            'level_user' => 'Super Admin'
        ]);
        LevelUser::create([
            'id_level_user' => 2,
            'level_user' => 'Admin'
        ]);

        // Seed Users
        $password = Hash::make('123456');
        $superAdmin = User::create([
            'nik' => 'SPRADM',
            'nama' => 'Super Admin',
            'email' => 'default@gmail.com',
            'password' => $password,
            'id_level_user' => 1
        ]);
        $adminAplikasi = User::create([
            'nik' => 'ADMAPK',
            'nama' => 'Admin Aplikasi',
            'email' => 'adminapk@gmail.com',
            'password' => $password,
            'id_level_user' => 2
        ]);

        // Satuan Unit
        $satuanUnit = Satuan::create([
            'nama' => 'Unit',
            'deskripsi' => 'Unit'
        ]);

        $satuanMeter = Satuan::create([
            'nama' => 'Meter',
            'deskripsi' => 'Meter'
        ]);

        $satuanPack = Satuan::create([
            'nama' => 'Pack',
            'deskripsi' => 'Pack'
        ]);

        // Seed GroupItems (ISMS dan ATK)
        $groupItemISMS = GroupItem::create([
            'nama' => 'ISMS',
            'deskripsi' => 'Peralatan IT dan Sistem Manajemen Keamanan Informasi (misal: komputer, CCTV, kabel, dll)'
        ]);
        $groupItemATK = GroupItem::create([
            'nama' => 'ATK',
            'deskripsi' => 'Peralatan kantor seperti kertas, alat tulis, bolpoin, dll'
        ]);

        // Seed Items (ISMS)
        $item1 = Item::create([
            'id_group_item' => $groupItemISMS->id_group_item,
            'nama' => 'Komputer Desktop',
            'deskripsi' => 'Komputer desktop dengan monitor LED dan aksesoris',
            'id_satuan' => $satuanUnit->id_satuan
        ]);
        $item2 = Item::create([
            'id_group_item' => $groupItemISMS->id_group_item,
            'nama' => 'CCTV Kamera',
            'deskripsi' => 'CCTV kamera untuk pengawasan',
            'id_satuan' => $satuanUnit->id_satuan
        ]);
        $item3 = Item::create([
            'id_group_item' => $groupItemISMS->id_group_item,
            'nama' => 'Kabel LAN',
            'deskripsi' => 'Kabel untuk jaringan komputer',
            'id_satuan' => $satuanMeter->id_satuan
        ]);

        // Seed Items (ATK)
        $item4 = Item::create([
            'id_group_item' => $groupItemATK->id_group_item,
            'nama' => 'Kertas A4',
            'deskripsi' => 'Kertas ukuran A4 untuk printer',
            'id_satuan' => $satuanPack->id_satuan
        ]);
        $item5 = Item::create([
            'id_group_item' => $groupItemATK->id_group_item,
            'nama' => 'Pensil',
            'deskripsi' => 'Pensil merk standar',
            'id_satuan' => $satuanPack->id_satuan
        ]);
        $item6 = Item::create([
            'id_group_item' => $groupItemATK->id_group_item,
            'nama' => 'Bolpoin',
            'deskripsi' => 'Bolpoin merk premium',
            'id_satuan' => $satuanPack->id_satuan
        ]);

        // Seed Stocks
        Stock::create([
            'id_item' => $item1->id_item,
            'available_stock' => 10
        ]);
        Stock::create([
            'id_item' => $item2->id_item,
            'available_stock' => 5
        ]);
        Stock::create([
            'id_item' => $item3->id_item,
            'available_stock' => 50
        ]);
        Stock::create([
            'id_item' => $item4->id_item,
            'available_stock' => 100
        ]);
        Stock::create([
            'id_item' => $item5->id_item,
            'available_stock' => 200
        ]);
        Stock::create([
            'id_item' => $item6->id_item,
            'available_stock' => 150
        ]);

        // Seed Transactions (Permintaan Barang)
        $transactionRequest = Transaction::create([
            'id_user' => $superAdmin->id_user,
            'transaction_type' => 'out',
            'penerima' => 'Divisi IT',
            'tanggal_transaction' => now(),
            'remarks' => 'Permintaan barang peralatan IT'
        ]);
        TransactionItem::create([
            'id_transaction' => $transactionRequest->id_transaction,
            'id_item' => $item1->id_item,
            'quantity' => 2,
            'remarks' => 'Komputer desktop untuk IT'
        ]);
        TransactionItem::create([
            'id_transaction' => $transactionRequest->id_transaction,
            'id_item' => $item2->id_item,
            'quantity' => 1,
            'remarks' => 'CCTV kamera untuk keamanan'
        ]);
        TransactionItem::create([
            'id_transaction' => $transactionRequest->id_transaction,
            'id_item' => $item3->id_item,
            'quantity' => 10,
            'remarks' => 'Kabel LAN untuk jaringan'
        ]);

        // Seed Transactions (Pembelian Barang)
        $transactionPurchase = Transaction::create([
            'id_user' => $adminAplikasi->id_user,
            'transaction_type' => 'in',
            'penerima' => 'Supplier ABC',
            'tanggal_transaction' => now(),
            'remarks' => 'Pembelian barang peralatan kantor'
        ]);
        TransactionItem::create([
            'id_transaction' => $transactionPurchase->id_transaction,
            'id_item' => $item4->id_item,
            'quantity' => 50,
            'remarks' => 'Kertas A4 untuk keperluan kantor'
        ]);
        TransactionItem::create([
            'id_transaction' => $transactionPurchase->id_transaction,
            'id_item' => $item5->id_item,
            'quantity' => 30,
            'remarks' => 'Pensil untuk kebutuhan kantor'
        ]);
        TransactionItem::create([
            'id_transaction' => $transactionPurchase->id_transaction,
            'id_item' => $item6->id_item,
            'quantity' => 40,
            'remarks' => 'Bolpoin untuk keperluan kantor'
        ]);

        // Seed Notifikasi
        Notifikasi::create([
            'id_user_pengirim' => $superAdmin->id_user,
            'id_user_penerima' => $adminAplikasi->id_user,
            'judul' => 'Notifikasi Pengajuan Barang',
            'isi' => 'Permintaan barang peralatan IT telah diajukan oleh Super Admin.',
            'status' => 1,
        ]);
        Notifikasi::create([
            'id_user_pengirim' => $adminAplikasi->id_user,
            'id_user_penerima' => $superAdmin->id_user,
            'judul' => 'Notifikasi Pembelian Barang',
            'isi' => 'Pembelian barang peralatan kantor telah diproses oleh Admin Aplikasi.',
            'status' => 1,
        ]);
    }
}
