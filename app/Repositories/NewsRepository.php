<?php
namespace App\Repositories;

use App\Models\NewsModel;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsRepository implements NewsRepositoryInterface
{

    public function all()
    {
        return (object) NewsModel::all();
    }

    public function show(string $id)
    {
        return (object) NewsModel::where('id', $id)->get();
    }

    public function create(object $request)
    {
        if (auth()->user() != null)
        {
            $create = new NewsModel();
            $create->title = $request->title;
            $create->content = $request->content;
            $create->save();

            return (array) [
                'ok' => true,
                'message' => "Новость добавлена",
            ];
        }else{
            return (array) [
                'message' => [
                    'ok' => false,
                    'error' => 403,
                    'message_error' => 'Доступ запрещен',
                ],
            ];
        }
    }

    public function update(object $request, string $id)
    {
        if (auth()->user() != null)
        {
            $update = new NewsModel();
            $title = $request->title;
            $content = $request->content;
            $update->where('id', $id)->update([
                'title' => $title,
                'content' => $content,
            ]);

            return (array) [
                'ok' => true,
                'message' => "Новость обновлена",
            ];
        }else{
            return (array) [
                'message' => [
                    'ok' => false,
                    'error' => 403,
                    'message_error' => 'Доступ запрещен',
                ],
            ];
        }
    }

    public function delete(string $id)
    {
        if (auth()->user() != null)
        {
            $delete = NewsModel::where('id', $id)->delete();
            return (array) [
                'message' => [
                    'ok' => true,
                    'num_delete_string' => $delete,
                ]
            ];
        }else{
            return (array) [
                'message' => [
                    'ok' => false,
                    'error' => 403,
                    'message_error' => 'Доступ запрещен',
                ],
            ];
        }
    }
}