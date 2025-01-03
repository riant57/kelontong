<?php
/**
 * Helpher untuk mencetak tanggal dalam format bahasa indonesia
 *
 * @package CodeIgniter
 * @category Helpers
 * @author Ardianta Pargo (ardianta_pargo@yhaoo.co.id)
 * @link https://gist.github.com/ardianta/ba0934a0ee88315359d30095c7e442de
 * @version 1.0
 */
/**
 * Fungsi untuk merubah bulan bahasa inggris menjadi bahasa indonesia
 * @param int nomer bulan, Date('m')
 * @return string nama bulan dalam bahasa indonesia
 */
if (!function_exists('bulan')) {
    function bulan($bulan){
        $bulan = $bulan['1'];
        switch ($bulan) {
            case 1:
                $bulan = "Jan";
                break;
            case 2:
                $bulan = "Feb";
                break;
            case 3:
                $bulan = "Mar";
                break;
            case 4:
                $bulan = "Apr";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Jun";
                break;
            case 7:
                $bulan = "Jul";  
                break;
            case 8:
                $bulan = "Agu";
                break;
            case 9:
                $bulan = "Sep";
                break;
            case 10:
                $bulan = "Okt";
                break;
            case 11:
                $bulan = "Nov";
                break;
            case 12:
                $bulan = "Des";
                break;
            default:
                $bulan = Date('F');
                break;
        }
        return $bulan;
    }
}
/**
 * Fungsi untuk membuat tanggal dalam format bahasa indonesia
 * @param void
 * @return string format tanggal sekarang (contoh: 22 Desember 2016)
 */
if (!function_exists('tanggal')) {
    function tanggal($bulan) {
        $bulan = explode("-",$bulan);
        $tanggal = substr($bulan['2'],0,2)."-".bulan($bulan)."-".$bulan['0'];
        return $tanggal;  
    }
}
if (!function_exists('tanggal_angka')) {
    function tanggal_angka($bulan) {
        $bulan = explode("-",$bulan);
        $tanggal = substr($bulan['2'],0,2)."-".$bulan['1']."-".$bulan['0']; 
        return $tanggal;  
    }
}