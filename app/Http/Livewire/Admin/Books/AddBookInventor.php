<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\BookInformation;
use App\Models\BookInventar;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddBookInventor extends Component
{
    use LivewireAlert;

    public Collection $inputs;
    public $book_inventars, $isActive = true, $book_inventar_id, $book_information_id, $book_id, $IsActive, $organization_id, $branch_id, $deportmetn_id, $book_information, $book;

    public $updateMode = false, $inventar_number, $key, $from, $to, $inventar;

    public function mount($infoid)
    {
        $this->book_information_id = $infoid;
        $this->book_information = BookInformation::find($infoid);

        $this->book_id = $this->book_information->book->id;
        $this->book = $this->book_information->book;
        $this->organization_id = $this->book_information->organization_id;
        $this->branch_id = $this->book_information->branch_id;
        $this->deportmetn_id = $this->book_information->deportmetn_id;

        $this->fill([
            'inputs' => collect([
                ['inventar_number' => ''],
            ]),
        ]);
    }
    public function render()
    {
        $this->book_inventars = BookInventar::where('book_id', '=', $this->book_id)->where('book_information_id', '=', $this->book_information_id)->where('branch_id', '=', $this->branch_id)->where('deportmetn_id', '=', $this->deportmetn_id)->orderBy('id', 'desc')->get();
        $this->book_information = BookInformation::find($this->book_information_id);

        return view('livewire.admin.books.add-book-inventor');
    }

    public function generate()
    {
        $this->validate(
            [

                'from' => 'required',
                'to' => 'required',
            ],
            [
                'from.required' =>  __('The :attribute field is required.'),
                'to.required' =>  __('The :attribute field is required.'),
            ],
            [
                'from' => __('from'),
                'to' => __('to'),
            ]
        );
        if ($this->from < $this->to) {
            DB::beginTransaction();
            try {
                for ($i = $this->from; $i <= $this->to; $i++) {
                    $bookInventar = BookInventar::where('inventar_number', '=', trim($this->key) . $i)->first();
                    if ($bookInventar == null) {
                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => trim($this->key),
                            'bar_code' => $i,
                            'inventar_number' => trim($this->key) . $i,
                            'inventar' => trim($this->key) . $i,
                        ];
                        $bookInventar = BookInventar::create($inventarData);
                    }
                }
                DB::commit();
                $this->alert('success',  __('Successfully saved'));
                $this->resetInputFields();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            } 
        } else {
            $this->alert('error',  __('from must be less than to'));
        }
    }
    public function save()
    {
        $this->validate(
            [

                'book_id' => 'required',
                'book_information_id' => 'required',
                'branch_id' => 'required',
                'deportmetn_id' => 'required',
                'inputs.*.inventar_number' => 'required|unique:book_inventars',
            ],
            [
                'inputs.*.inventar_number.required' =>  __('The :attribute field is required.'),
                'inputs.*.inventar_number.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inputs.*.inventar_number' => __('Inventar Number'),
            ]
        );

        if ($this->inputs->count() > 0) {
            DB::beginTransaction();
            try {
                foreach ($this->inputs as $key => $value) {
                    $invent= trim($value['inventar_number']);
                    $inventarIsExists =  BookInventar::where('inventar_number', '=', $invent)->first();


                    $pattern = "/(\d+)/";
                    $array = preg_split($pattern, $invent, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                    $key=null;
                    $barcode=$invent;
                    if(count($array)>1){
                        $key=$array[0];
                        $barcode=$array[1];    
                    }
                    $inventarData = [
                        'isActive' => true,
                        'book_id' => $this->book_id,
                        'book_information_id' => $this->book_information_id,
                        'organization_id' => $this->organization_id,
                        'branch_id' => $this->branch_id,
                        'deportmetn_id' => $this->deportmetn_id,
                        'inventar_number' => $invent,
                        'inventar' => $invent,
                        'key' => $key,
                        'bar_code' => $barcode,
                    ];
                    if($inventarIsExists==null){
                        $bookInventar = BookInventar::create($inventarData);
                    }else{
                        $this->alert('error',  __("The inventar number has already been taken."));
                        $this->resetInputFields();
                        return false;
                    }
                }


                DB::commit();
                $this->alert('success',  __('Successfully saved'));

                $this->resetInputFields();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        }
    }
    private function removeElementWithValue($array, $key, $value)
    {
        foreach ($array as $subKey => $subArray) {
            if ($subArray[$key] == $value) {
                unset($array[$subKey]);
            }
        }
        return $array;
    }
    private function resetInputFields()
    {
        $this->inventar_number = '';
        $this->key = null;
        $this->from = null;
        $this->to = null;
        $this->fill([
            'inputs' => collect([
                ['inventar_number' => ''],
            ]),
        ]);
    }
    // private function resetInput()
    // {
    //     $this->branch_id = null;
    //     $this->department_id = null;
    //     $this->arrived_year = null;
    //     $this->summarka_raqam = null;
    //     $this->kutubxonada_bor = true;
    //     $this->elektronni_bor = true;
    //     $this->isActive = true;
    // }
    public function edit($id)
    {
        $book_inventar = BookInventar::findOrFail($id);
        $this->book_inventar_id = $book_inventar->id;
        $this->inventar_number = $book_inventar->inventar_number;
        $this->isActive = $book_inventar->isActive;
        // $this->book_information_id = $id;

        // $this->branch_id = $book_info->branch_id;
        // $this->isActive = $book_info->isActive;
        // $this->deportmetn_id = $book_info->deportmetn_id;
        // $this->arrived_year = $book_info->arrived_year;
        // $this->summarka_raqam = $book_info->summarka_raqam;
        // $this->kutubxonada_bor = $book_info->kutubxonada_bor;
        // $this->elektronni_bor = $book_info->elektronni_bor;
        // $this->book_id  = $book_info->book_id ;
        $this->updateMode = true;
        // return true;
    }
    public function update()
    {
        $this->validate(
            [
                'inventar_number' => 'required|unique:book_inventars,inventar_number,' . $this->book_inventar_id,
            ],
            [
                'inventar_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inventar_number' => __('Inventar Number'),
            ]
        );
        if ($this->book_inventar_id) {
            $record = BookInventar::find($this->book_inventar_id);
            // $input = [
            //     'organization_id' => $this->organization_id,
            //     'isActive' => $this->isActive,
            //     'inventar_number' => trim($this->inventar_number),
            // ];
            $invent= trim($this->inventar_number);
            $pattern = "/(\d+)/";
            $array = preg_split($pattern, $invent, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $key=null;
            $barcode=$invent;    

            if(count($array)>1){
                $key=$array[0];
                $barcode=$array[1];    
            }
            $inventarData = [
                'isActive' => $this->isActive,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'deportmetn_id' => $this->deportmetn_id,
                'inventar_number' => $invent,
                'inventar' => $invent,
                'key' => $key,
                'bar_code' => $barcode,
            ];
             
            $record->update($inventarData);
            // $this->resetInput();
            $this->updateMode = false;
            $this->resetInputFields();
            $this->alert('success',  __('Successfully saved'));
            return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id . '/' . $this->book_information_id);

            // return true;
            // return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id);
            // return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id . '/' . $this->book_information_id);

        }
    }
    public function addInput()
    {
        $this->inputs->push(['inventar_number' => '']);
    }

    public function removeInput($key)
    {

        $this->inputs->pull($key);
    }

    public function removeInventar($inventar_id)
    {
        $book_inventar = BookInventar::find($inventar_id);
        $book_inventar->isActive = false;
        $book_inventar->save();
    }
    public function editInventar($inventar_id)
    {
        $book_inventar = BookInventar::find($inventar_id);
        $book_inventar->isActive = true;
        $book_inventar->save();
    }
}
