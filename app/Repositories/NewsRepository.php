<?php
namespace App\Repositories;

use App\Models\NewsModel;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsRepository implements NewsRepositoryInterface
{

    public function all(): object
    {
        return NewsModel::all();
    }

    public function show(string $id): object
    {
        return NewsModel::where('id', $id)->get();
    }

    public function create(object $request): object
    {
        if (auth()->user() != null)
        {
            $create = new NewsModel();
            $create->title = $request->title;
            $create->content = $request->content;
            $create->save();

            return (object) [
                'ok' => true,
                'message' => "Новость добавлена",
            ];
        }else{
            return (object) [
                'message' => [
                    'ok' => false,
                    'error' => 403,
                    'message_error' => 'Доступ запрещен',
                ],
            ];
        }
    }

    public function update(object $request, string $id): object
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

            return (object) [
                'ok' => true,
                'message' => "Новость обновлена",
            ];
        }else{
            return (object) [
                'message' => [
                    'ok' => false,
                    'error' => 403,
                    'message_error' => 'Доступ запрещен',
                ],
            ];
        }
    }

    public function delete(string $id): object
    {
        if (auth()->user() != null)
        {
            $delete = NewsModel::where('id', $id)->delete();
            return (object) [
                'message' => [
                    'ok' => true,
                    'num_delete_string' => $delete,
                ]
            ];
        }else{
            return (object) [
                'message' => [
                    'ok' => false,
                    'error' => 403,
                    'message_error' => 'Доступ запрещен',
                ],
            ];
        }
    }
}