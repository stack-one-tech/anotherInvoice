<?php

namespace App\Http\Livewire;

use App\Models\CompanyInfo;
use App\Models\Invoice;
use App\Models\Product;
use Auth;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CreateInvoice extends Component
{


    public array $newInvoice;
    public $addProductModalIsOpen = false;
    public $searchResultReciverCompany = null;
    public $customer = null;
    public $sender = null;

    public $companyList = null;
    public $invoices;

    public $productList = null;
    /**
     * @var true
     */
    public bool $preview_pdf = false;

    public $editMode = false;
    public $editId = null;

    public function mount()
    {
        $this->sender = CompanyInfo::find(Auth::user()->company_id);

        $this->companyList = CompanyInfo::all();
        $this->invoices = Invoice::all();
        $this->newInvoice = [
            "reciverID" => null,
            "senderID" => "1",
            "serviceTimeText" => 'Leistungszeitraum: '.Carbon::now()->setDay(1)->subMonth()->format('d.m.Y').' - '.Carbon::now()->subMonth()->lastOfMonth()->format('d.m.Y'),
            "invoiceNumber" => 'RE' . $this->getInvoiceNumber() + 1,
            "invoiceDate" => Carbon::now()->format('d.m.Y'),
            "customerNumber" => "TODO",
            "openingText" => "Sehr geehrte Damen und Herren,\n hiermit stellen wir Ihnen die Rechnung für unsere Leistungenaus.",
            "closingText" => "Wir danken für Ihr Vertrauen und freuen uns auf eine weitere Zusammenarbeit.\n Mit freundlichen Grüßen,\n Maria Musterfrau",
            "paymentTerms" => "zahlbar innerhalb von 14 Tagen ohne Abzug.",
            "invoice_items" => "[]",
            "ustNotice" => "",
        ];

        if (session()->has('editInvoice')) {
            $invID = session()->get('editInvoice');
            $this->editMode = true;
            $this->editId = $invID;
            $this->newInvoice = Invoice::find($invID)->toArray();
        }

        $this->customer = CompanyInfo::all()->first();

        $this->productList = Product::all();
    }

    public function updateInvoice($id, $field, $value) // Function to update an invoice
    {
        $invoice = Invoice::find($id);
        $invoice->$field = $value;
        $invoice->save();
    }

    public function addProduct($id)
    {
        $newInvoice = json_decode($this->newInvoice['invoice_items'], true);

        $newInvoice[] = [
            "product_id" => $id,
            "qty" => 1
        ];

        $this->newInvoice['invoice_items'] = json_encode($newInvoice);
    }

    public function deleteProduct($id)
    {
        $newInvoice = json_decode($this->newInvoice['invoice_items'], true);

        unset($newInvoice[$id]);

        $this->newInvoice['invoice_items'] = json_encode(array_values($newInvoice));
        $this->render();
    }

    public function render()
    {
        if ($this->newInvoice['reciverID'] != null) {
            $this->customer = CompanyInfo::find($this->newInvoice['reciverID']);
//            $this->customerNumbr = CompanyInfo::find($this->newInvoice['reciverID'])?->customerNumbr;
        }

        return view('livewire.create-invoice');
    }

    public function redirectBack()
    {
        return redirect()->route('home');
    }

    public function updateQty($pos, $qty)
    {
        $newInvoice = json_decode($this->newInvoice['invoice_items'], true);

        $newInvoice[$pos]['qty'] = $qty;

        $this->newInvoice['invoice_items'] = json_encode($newInvoice);
    }


    public function saveInvoice()
    {
        if ($this->editMode) {
            $invoice = Invoice::find($this->editId);
            $this->fillInvoice($invoice);
            return redirect()->route('home');
        }
        $invoice = new Invoice();
        $this->fillInvoice($invoice);
        return redirect()->route('home');
    }

    /**
     * @throws RequestException
     */
    public function testGenerateInvoice()
    {

        $senderAddress = [
            'fullForename' => $this->sender->fullForename,
            'fullSurname' => $this->sender->fullSurname,
            'companyName' => $this->sender->companyName,
            'supplement' => $this->sender->supplement,
            'address' => [
                'road' => $this->sender->road,
                'houseNumber' => $this->sender->houseNumber,
                'streetSupplement' => $this->sender->streetSupplement,
                'zipCode' => $this->sender->zipCode,
                'cityName' => $this->sender->cityName,
                'country' => 'Deutschland',
                'countryCode' => 'DE'
            ]
        ];

        $receiverAddress = [
            'fullForename' => $this->customer->fullForename,
            'fullSurname' => $this->customer->fullSurname,
            'companyName' => $this->customer->companyName,
            'supplement' => $this->customer->supplement,
            'address' => [
                'road' => $this->customer->road,
                'houseNumber' => $this->customer->houseNumber,
                'streetSupplement' => $this->customer->streetSupplement,
                'zipCode' => $this->customer->zipCode,
                'cityName' => $this->customer->cityName,
                'country' => 'Deutschland',
                'countryCode' => 'DE'
            ]
        ];

        $senderInfo = [
            'phone' => $this->sender->phone,
            'web' => $this->sender->web,
            'email' => $this->sender->email,
            'mimeLogoUrl' => $this->sender->mimeLogoUrl,
            'mimeLogoScale' => floatval($this->sender->mimeLogoScale),
            'iban' => $this->sender->iban,
            'bic' => $this->sender->bic,
            'taxNumber' => $this->sender->taxNumber,
            'bankName' => $this->sender->bankName
        ];

        $invoiceMeta = [
            'invoiceNumber' => $this->newInvoice['invoiceNumber'],
            'invoiceDate' => $this->newInvoice['invoiceDate'],
            'customerNumber' => $this->customer->customerNumbr,
        ];

        $invoiceItems = [];

        foreach (json_decode($this->newInvoice['invoice_items']) as $key => $item) {
            $product = Product::find($item->product_id);

            $invoiceItems[] = [
                'positionNumber' => strval($key),
                'quantity' => floatval($item->qty),
                'unit' => $product->unit,
                'description' => $product->name,
                'singlePrice' => intval($product->singlePrice),
                'currency' => '€',
                'taxRate' => 19
            ];
        }

        $invoiceBody = [
            'openingText' => $this->newInvoice['openingText'],
            'serviceTimeText' => $this->newInvoice['serviceTimeText'],
            'headlineText' => 'Rechnung',
            'closingText' => $this->newInvoice['closingText'],
            'ustNotice' => $this->newInvoice['ustNotice'],
            'invoicedItems' => $invoiceItems
        ];

        $data = compact('senderAddress', 'receiverAddress', 'senderInfo', 'invoiceMeta', 'invoiceBody');


        // Send JSON data to API
        $fileResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://pdf.3nq.de/pdf', $data);

        //dd(json_encode($data,JSON_UNESCAPED_UNICODE));

        if ($fileResponse->ok()) {
            $content = $fileResponse->getBody();
            Storage::put('preview.pdf', $content, []);
        }

        $this->preview_pdf = true;
    }


    public function fillInvoice(Invoice $invoice)
    {
        $invoice->reciverID = $this->newInvoice['reciverID'];
        $invoice->invoiceNumber = $this->newInvoice['invoiceNumber'];
        $invoice->invoiceDate = $this->newInvoice['invoiceDate'];
        $invoice->customerNumber = $this->newInvoice['customerNumber'];
        $invoice->openingText = $this->newInvoice['openingText'];
        $invoice->closingText = $this->newInvoice['closingText'];
        $invoice->paymentTerms = $this->newInvoice['paymentTerms'];
        $invoice->invoice_items = $this->newInvoice['invoice_items'];
        $invoice->ustNotice = $this->newInvoice['ustNotice'];
        $invoice->serviceTimeText = $this->newInvoice['serviceTimeText'];
        $invoice->save();

    }

    private function getInvoiceNumber()
    {
        $invoices = Invoice::all();
        // map the invoice numbers to their numeric portion
        $numbers = $invoices->map(fn($invoice) => intval(substr($invoice->invoiceNumber, 2)))
            ->sortByDesc(fn($number) => $number);
        if ($numbers->isEmpty()) {
            return null;
        }
        // convert the biggest number back to a string and prepend the prefix
        return $numbers->first();

    }
}
