<?php

namespace App\Http\Livewire;

use App\Models\CompanyInfo;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Invoicer extends Component
{
    public $activeMenue = 'invoices';
    public $productList = null;
    public $invoiceList = null;
    public $companyInfoList = null;

    public $new_product = null;
    public $new_companyInfo = null;

    public $create_product_isOpen = false;
    public $create_companyInfo_isOpen = false;
    /**
     * @var true
     */
    public $editModeCompInfo = false;
    /**
     * @var false
     */
    public $editModeProd = false;

    public function mount()
    {
        $this->productList = Product::all();
        $this->invoiceList = Invoice::all();
        $this->companyInfoList = CompanyInfo::all();
        $this->new_product = [
            'name' => 'Name des Produktes',
            'singlePrice' => '1000',
            "unit" => 'Stk.',
            'currency' => '€',
            'tax_rate' => '19 %',
        ];

        $this->new_companyInfo = [
            "customerNumbr" => 'KD' . $this->getCustomerNumber() + 1,
            "fullForename" => 'Johann',
            "fullSurname" => 'Schmidt',
            "companyName" => 'Schmidt GmbH',
            "supplement" => 'Büro 3',
            "road" => 'Hauptstraße',
            "houseNumber" => '25',
            "streetSupplement" => 'zu Händen von Frau Müller',
            "zipCode" => '12345',
            "cityName" => 'Berlin',
            "country" => 'Deutschland',
            "countryCode" => 'DE',
            "phone" => '+49 30 123456',
            "web" => 'www.schmidt-gmbh.de',
            "email" => 'info@schmidt-gmbh.de',
            "mimeLogoUrl" => 'https://www.example.com/logo.png',
            "mimeLogoScale" => '1.5',
            "iban" => 'DE12345678901234567890',
            "bic" => 'ABCDEFGH',
            "taxNumber" => '123/456/78901',
            "bankName" => 'Commerzbank AG',
        ];
    }




    public function render()
    {
        return view('livewire.invoicer');
    }

    public function editProduct($p_id)
    {
        $this->new_product = Product::find($p_id)->toArray();
        $this->new_product['tax_rate'] = $this->convertDecimalToPercentage($this->new_product['tax_rate']);
        $this->create_product_isOpen = true;
        $this->editModeProd = true;
    }

    public function deleteProduct($p_id)
    {
        Product::find($p_id)->delete();
        $this->productList = Product::all();
    }

    private function getCustomerNumber()
    {
        $invoices = CompanyInfo::all();
        // map the invoice numbers to their numeric portion
        $numbers = $invoices->map(fn($invoice) => intval(substr($invoice->customerNumbr, 2)))
            ->sortByDesc(fn($number) => $number);
        if ($numbers->isEmpty()) {
            return null;
        }
        // convert the biggest number back to a string and prepend the prefix
        return $numbers->first();

    }

    public function saveProduct()
    {
        //convert taxrate from string (19% or 7% or 0%) to decimal

        $this->new_product['tax_rate'] = $this->convertTxRate($this->new_product['tax_rate']);

        if ($this->editModeProd) {
            Product::find($this->new_product['id'])->update($this->new_product);
            $this->editModeProd = false;
        } else {
            Product::create($this->new_product);
        }

        $this->create_product_isOpen = false;
        $this->productList = Product::all();
    }


    public function editCompanyInfo($c_id)
    {
        $this->new_companyInfo = CompanyInfo::find($c_id)->toArray();
        $this->create_companyInfo_isOpen = true;
        $this->editModeCompInfo = true;
    }

    public function deleteCompanyInfo($c_id)
    {
        CompanyInfo::find($c_id)->delete();
        $this->companyInfoList = CompanyInfo::all();
    }

    public function saveCompanyInfo()
    {
        if ($this->editModeCompInfo) {
            CompanyInfo::find($this->new_companyInfo['id'])->update($this->new_companyInfo);
            $this->editModeCompInfo = false;
        } else {
            CompanyInfo::create($this->new_companyInfo);
        }

        $this->create_companyInfo_isOpen = false;
        $this->companyInfoList = CompanyInfo::all();
    }

    function convertTxRate($txRate)
    {
        $decimal = floatval(str_replace('%', '', $txRate)) / 100;
        return number_format($decimal, 2);
    }

    function convertDecimalToPercentage($decimal)
    {
        return number_format($decimal * 100, 2)." %";
    }

    public function deleteInvoice($id) {
        Invoice::find($id)->delete();
        $this->invoiceList = Invoice::all();
    }

    public function editInvoice($id) {
        session()->flash('editInvoice', $id);
        return redirect()->to(route('create_invoice'));
    }
}
