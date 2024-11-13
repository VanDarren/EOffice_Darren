<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class eoffice extends Model
{

    public function sqlquery($query)
    {
        return DB::select(DB::raw($query));
    }

    public function tampil($table)
    {
        $this->setTable($table);
        return DB::table($this->table)->get();
    }

    public function tambah($table, $data)
    {
        $this->setTable($table); 
        return DB::table($this->table)->insert($data); 
    }

    public function getWhere($table, $where)
{
    return DB::table($table)->where($where)->first();
}

public function getData($table, $where = null)
{
    // Set tabel yang akan digunakan
    $this->setTable($table);
    
    // Jika ada kondisi, tambahkan klausa where
    if ($where) {
        return DB::table($this->table)->where($where)->get();
    }
    
    // Jika tidak ada kondisi, ambil semua data
    return DB::table($this->table)->get();
}

public function edit($table, $where, $data)
{
    $this->setTable($table);
    return DB::table($this->table)->where($where)->update($data);
}

public function hapus($table, $where)
{
    $this->setTable($table);
    return DB::table($this->table)->where($where)->delete();
}

    public function tampil2($tabel)
    {
        return DB::table($tabel)
                 ->whereNull('deleted_at') 
                 ->get();
    }

    public function join($table1, $table2, $on1, $on2) {
        $this->setTable($table1);
        return DB::table($this->table)
                    ->join($table2, $on1, '=', $on2) 
                    ->get(); 
    }

    public function join2($table1, $table2, $on1, $on2) {
        $this->setTable($table1);
        return DB::table($this->table)
                    ->join($table2, $on1, '=', $on2)
                    ->whereNull('deleted_at')  
                    ->get(); 
    }

    public function join3($table1, $table2, $table3, $on1, $on2, $on3, $on4)
    {
        $this->setTable($table1);
        return DB::table($this->table)
                    ->join($table2, $on1, '=', $on2)
                    ->join($table3, $on3, '=', $on4)
                    ->whereNull('deleted_at')  
                    ->get(); 
    }

    public function getLogData()
    {
        return DB::table('log')
                 ->select('log.*', 'user.username')
                 ->join('user', 'log.id_user', '=', 'user.id_user')
                 ->orderBy('time', 'DESC')
                 ->get();
    }

    public function logActivity($data)
    {
        return DB::table('log')->insert($data);
    }

  
    public function getBackupData()
    {
        return DB::table('user_backup')->get();
    }
  
    public function getProductById($id)
    {
        return DB::table('user')->where('id_user', $id)->first();
    }

    public function getUserdanLevel()
    {
        return DB::table('user')
            ->join('level', 'user.id_level', '=', 'level.id_level')
            ->get();
    }
    
    public function getDocumentsByLevel($id_level)
    {
        return DB::table('suratmasuk')
                 ->where('id_level', $id_level)
                 ->get();
    }
    
    public function getDocumentsByUser($id_user)
    {
        return DB::table('suratmasuk')
                 ->where('id_user', $id_user)
                 ->get();
    }


    
}

