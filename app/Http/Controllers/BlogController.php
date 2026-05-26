<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

use Image;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $Blogs = Blog::orderBy('blogId', 'desc')
                ->where(['iStatus' => 1, 'isDelete' => 0])
                ->paginate(config('app.per_page'));
            // dd($Blog);

            return view('Blog.index', compact('Blogs'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function createview(Request $request)
    {
        try {

            return view('Blog.add');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'strTitle' => 'required',
                'strDescription' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (trim(strip_tags($value)) === '') {
                            $fail('The description is required.');
                        }
                    }
                ],
                'strPhoto' => 'required'
            ], [
                'strTitle.required' => 'The title field is required.',
                'strDescription.required' => 'The description field is required.',
                'strPhoto.required' => 'The photo field is required.'
            ]);

            $TitleLoverCase = Str::lower($request->strTitle);
            $Title = str_replace(' ', '-', $TitleLoverCase);

            $img = "";
            if ($request->hasFile('strPhoto')) {

                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('strPhoto');
                $imgName = time() . '_' . mt_rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $destinationPath = $root . '/upload/Blog';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $destinationpath = $root . '/upload/Blog/';
                $image->move($destinationpath, $imgName);
            }

            Blog::create([
                'strTitle' => $request->strTitle,
                'strSlug' => $Title,
                'strDescription' => $request->strDescription,
                'strPhoto' => $imgName,
                'metaTitle' => $request->metaTitle,
                'metaKeyword' => $request->metaKeyword,
                'metaDescription' => $request->metaDescription,
                'head' => $request->head,
                'body' => $request->body,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip()
            ]);

            return redirect()->route('blog.index')->with('success', 'Blog Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function editview(Request $request, $id)
    {
        try {
            $data = Blog::where(['iStatus' => 1, 'isDelete' => 0, 'blogId' => $id])->first();

            return view('Blog.edit', compact('data'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'strTitle' => 'required',
                'strDescription' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (trim(strip_tags($value)) === '') {
                            $fail('The description is required.');
                        }
                    }
                ],
            ], [
                'strTitle.required' => 'The title field is required.',
                'strDescription.required' => 'The description field is required.'
            ]);

            $TitleLoverCase = Str::lower($request->strTitle);
            $Title = str_replace(' ', '-', $TitleLoverCase);

            $img = "";
            if ($request->hasFile('edit_img')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('edit_img');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/Blog/';
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image->move($destinationpath, $img);
                $oldImg = $request->input('hiddenPhoto') ? $request->input('hiddenPhoto') : null;

                if ($oldImg != null || $oldImg != "") {
                    if (file_exists($destinationpath . $oldImg)) {
                        unlink($destinationpath . $oldImg);
                    }
                }
            } else {
                $oldImg = $request->input('hiddenPhoto');
                $img = $oldImg;
            }


            Blog::where(['iStatus' => 1, 'isDelete' => 0, 'blogId' => $id])
                ->update([
                    'strTitle' => $request->strTitle,
                    'strSlug' => $Title,
                    'strDescription' => $request->strDescription,
                    'strPhoto' => $img,
                    'metaTitle' => $request->metaTitle,
                    'metaKeyword' => $request->metaKeyword,
                    'metaDescription' => $request->metaDescription,
                    'head' => $request->head,
                    'body' => $request->body,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            return redirect()->route('blog.index')->with('success', 'Blog Updated Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $delete = Blog::where(['iStatus' => 1, 'isDelete' => 0, 'blogId' => $request->id])->first();
            $root = $_SERVER['DOCUMENT_ROOT'];
            $destinationpath1 = $root . '/upload/Blog/';

            if (file_exists($destinationpath1 . $delete->strPhoto)) {
                unlink($destinationpath1 . $delete->strPhoto);
            }


            Blog::where(['iStatus' => 1, 'isDelete' => 0, 'blogId' => $request->id])->delete();
            Toastr::success('Blog deleted successfully :)', 'Success');
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
