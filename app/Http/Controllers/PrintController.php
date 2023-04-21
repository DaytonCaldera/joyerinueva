<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class PrintController extends Controller
{
    //

    public function printTicket()
    {
        // Open the ticket printer
        $connector = new WindowsPrintConnector("USB001");
        $printer = new Printer($connector);

        // Print the ticket
        $printer->text("Hello, world!\n");

        // Close the ticket printer
        $printer->close();
    }
}
