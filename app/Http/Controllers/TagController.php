<?php

namespace App\Http\Controllers;

use App\Models\Tag;


use App\Http\Requests\Tag\Request as TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TagController extends Controller
{

    protected const TAGS_PER_PAGE = 15;

    public function index()
    {

        return view('tags.index', [
            'tags' => $this->getAuthorizedUser()->tags()->paginate(self::TAGS_PER_PAGE)

        ]);
    }

    public function add()
    {

        return view('tags.add');
    }

    public function store(TaskRequest $request)
    {
        $tag = $this->getAuthorizedUser()->tags()->save(
            new Tag($request->validated())
        );


        if ($tag) {
            $request->session()->flash('status', "Tag o nazwie: {$tag->name} został dodany");


            return redirect()->route('tags.edit',[
                'tag' => $tag,
    
            ]);
        } else {
            session()->flash('status', "Wystąpił błąd");


            return redirect()->route('tags.edit',[
                'tag' => $tag,
    
            ]);
        }
    }

    public function edit(Tag $tag)
    {

        return view('tags.edit',[
            'tag' => $tag,

        ]);
    }

    public function update(TaskRequest $request, Tag $tag)
    {

        if (!$tag->owner->isCurrentlyAuthorized()) {
            return abort(403);
        }


        if ($tag->update($request->validated())) {
            session()->flash('status', "Tag o nazwie: {$tag->name} został zaktualizowany");
          
            return redirect()->route('tags.edit',[
                'tag' => $tag,
    
            ]);
        } else {
            session()->flash('status', "Wystąpił błąd");

            return redirect()->route('tags.edit',[
                'tag' => $tag,
    
            ]);
        }
    }
    

    public function delete(Request $request, Tag $tag)
    {

        
        if (!$tag->owner->isCurrentlyAuthorized()) {
            return abort(403);
        }


        if ($tag->delete()) {
            session()->flash('status', "Tag o nazwie: {$tag->name} został usunięty");


           
            return redirect(
                route(
                    'tags.index'


                )

            );
        } else {
            session()->flash('status', "Wystąpił błąd");

            return redirect(
                route(
                    'tags.index'


                )

            );
        }
    }
}

