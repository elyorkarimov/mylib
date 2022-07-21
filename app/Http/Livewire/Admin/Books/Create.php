<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Import;
use App\Models\Subject;
use App\Models\Where;
use App\Models\Who;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $branches, $book, $bookSubjects, $bookFileTypes, $bookAccessTypes, $bookTextTypes, $bookTexts, $bookLanguages, $bookTypes, $bookAuthors, $new_subjects, $wheres, $whos;
    public $departments;
    public $book_face_image, $book_full_text;
    public $dc_title, $authors_mark, $dc_published_city, $dc_publisher, $dc_UDK, $ISBN, $dc_description, $dc_source, $dc_date, $betlar_soni = 0, $price = 0, $status = '1', $books_type, $book_language, $book_text, $book_text_type, $book_access_type, $book_file_type;
    public $selectedBranches = NULL, $new_subject, $where_id, $who_id;
    public $dc_authors = [], $subjects = [], $import_book_id=0;
    // public $organization_id,$branch_id, $department_id;
    
    public function mount($import_book)
    {
        if(!is_null($import_book)){
            $this->import_book_id=$import_book->id;
            $this->dc_title=$import_book->title;
            $author=[$import_book->authors];
            $this->dc_authors=$author;
            $this->dc_publisher=$import_book->publisher;
            $this->dc_published_city=$import_book->published_city;
            $this->dc_date=$import_book->published_year;
            $this->price=$import_book->price;
        }
        // $roles = Auth::user()->getRoleNames()->toArray();
        // if(count($roles)>0){
        //     $user = Auth::user()->profile;
        //     $this->organization_id = $user->organization_id;
        //     $this->branch_id = $user->branch_id;
        //     $this->department_id = $user->department_id;
            
        // }
    }

    public function render()
    { 
        $this->book = new Book();
        $this->bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $this->bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->new_subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->whos = Who::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('livewire.admin.books.create');
    }

    public function save()
    {
        $this->validate(
            [
                'dc_title' => 'required|min:3',
                'dc_authors' => 'required',
                'dc_date' => 'required',
                'betlar_soni' => 'required',
                'betlar_soni' => 'required',
                'books_type' => 'required',
            ],
            [
                'dc_title.required' =>  __('The :attribute field is required.'),
                'dc_authors.required' =>  __('The :attribute field is required.'),
                'dc_date.required' =>  __('The :attribute field is required.'),
                'betlar_soni.required' =>  __('The :attribute field is required.'),
                'books_type.required' =>  __('The :attribute field is required.'),
            ],
            [
                'dc_title' => __('Dc Title'),
                'dc_authors' => __('Dc Authors'),
                'dc_date' => __('Dc Date'),
                'betlar_soni' => __('Betlar Soni'),
                'books_type' => __('Books Type'),
            ]
        );

        // $this->book_face_image->storeAs('book_face_image');
        // $imagename = time().md5(uniqid(rand(), true)).'.'.$this->book_face_image->extension();
        $image_path = null;
        if ($this->book_face_image != null) {
            $image_path = $this->book_face_image->store('books/face/images', 'public');
        }

        if ($this->subjects!=null&& count($this->subjects) > 0) {
            foreach ($this->subjects as $k => $v) {
                $book_subjects = BookSubject::whereTranslation("title", $v)->first();
                if ($book_subjects == null) {
                    $data = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $data[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    BookSubject::create($data);
                }
            }
        }
        if (count($this->dc_authors) > 0) {
            foreach ($this->dc_authors as $k => $v) {
                $author = Author::whereTranslation("title", $v)->first();
                if ($author == null) {
                    $authorData = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    Author::create($authorData);
                }
            }
        }
        
        $new_subject_id=null;
        if ($this->new_subject != null) {
             
            $old_subject = Subject::find($this->new_subject);
            if ($old_subject == null) {
                $subjectData = null;
                $count = 0;
                foreach (config('app.locales') as $til_code => $locale) {
                    $subjectData[$til_code] = [
                        'title' => $this->new_subject
                    ];
                    $count += 1;
                }
               
                $old_subjcts = Subject::create($subjectData);
                $new_subject_id=$old_subjcts->id;
            }else{
                $new_subject_id= $old_subject->id;
            }
            $old_subject=null;     
        }


        $full_text_path = null;
        $file_format = null;
        $file_format_type = null;
        $file_size = null;
        if ($this->book_full_text != null) {
            $full_text_path = $this->book_full_text->store('books/fulltext', 'public');
            $file_format = $this->book_full_text->getClientOriginalExtension();
            $file_format_type = $this->book_full_text->getMimeType();
            $file_size = $this->book_full_text->getSize();
        }
        $old_book = Book::where('dc_title', '=', trim($this->dc_title))->where('published_year', '=', trim($this->dc_date))->where('dc_authors', '=', json_encode($this->dc_authors))->first();
        if($old_book!=null){
            $this->alert('error',  __('This data has already exist please fill another one!'));
            $this->resetInputFields();
            return true;
        }else{
            $input = [
                'dc_title' => trim($this->dc_title),
                'authors_mark' => trim($this->authors_mark),
                'dc_subjects' => json_encode($this->subjects),
                'dc_creators' => json_encode($this->dc_authors),
                'dc_authors' => json_encode($this->dc_authors),
                'dc_UDK' => trim($this->dc_UDK),
                'dc_source' => trim($this->dc_source),
                'dc_publisher' => trim($this->dc_publisher),
                'dc_published_city' => trim($this->dc_published_city),
                'ISBN' => trim($this->ISBN),
                'dc_description' => trim($this->dc_description),
                'dc_date' => trim($this->dc_date),
                'betlar_soni' => trim($this->betlar_soni),
                'price' => trim($this->price),
                'status' => $this->status,
                'published_year' => trim($this->dc_date),
                'image_path' => $image_path,
                'books_type_id' => $this->books_type,
                'book_language_id' => $this->book_language,
                'book_text_id' => $this->book_text,
                'book_text_type_id' => $this->book_text_type,
                'book_access_type_id' => $this->book_access_type,
                'book_file_type_id' => $this->book_file_type,
                'where_id' => $this->where_id,
                'who_id' => $this->who_id,
                'subject_id' => $new_subject_id,
                'full_text_path' => $full_text_path,
                'file_format' => $file_format,
                'file_format_type' => $file_format_type,
                'file_size' => $file_size,
            ];
            
            DB::beginTransaction();
    
            try {
                $book = Book::create($input);
 
              
                DB::commit();
                $this->resetInputFields();
                $import = Import::find($this->import_book_id);
                $import->status=2;
                $import->save();
                $this->alert('success',  __('Successfully saved'));
                // return redirect()->route('dashboard');
                return redirect()->to(app()->getLocale() . '/admin/books/' . $book->id);
            } catch (\Exception $e) {
                DB::rollback();
                // Send error back to user
            }
        }


    }
    private function resetInputFields()
    {
        $this->dc_title = null;
        $this->authors_mark = null;
        $this->subjects = [];
        $this->dc_authors = [];
        $this->dc_UDK = null;
        $this->dc_source = null;
        $this->dc_publisher = null;
        $this->dc_published_city = null;
        $this->ISBN = null;
        $this->dc_description = null;
        $this->dc_date = null;
        $this->betlar_soni = 0;
        $this->price = 0;
        $this->status = true;
        $this->dc_date = null;
        $this->books_type = null;
        $this->book_language = null;
        $this->book_text = null;
        $this->book_text_type = null;
        $this->book_access_type = null;
        $this->book_file_type = null;
    }
}
