<?php

namespace App\Enum;

enum DispositionReasonEnum: string
{
    case UntukDiketahui = 'untuk diketahui';
    case UntukDiperhatikan = 'untuk diperhatikan';
    case UntukDipelajari = 'untuk dipelajari';
    case DisiapkanJawaban = 'disiapkan jadwaban';
    case JawabLangsung = 'jawab langsung';
    case ACCUntukDitindaklanjuti = 'ACC untuk ditindaklanjuti';
    case AmbilLangkahSeperlunya = 'ambil langkah seperlunya';
    case Dibicarakan = 'dibicarakan';
    case Dilaporkan = 'dilaporkan';
    case SegeraSelesaikan = 'segera selesaikan';
    case CopyUntuk = 'copy untuk …';
    case Arsip = 'arsip';
    case Lainnya = 'lainnya';
}
