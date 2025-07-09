<?php

namespace App\Models;

use Google\Cloud\Firestore\FirestoreClient;

class KandidatFirebase
{
    protected $firestore;
    protected $collection = 'kandidats';

    public function __construct()
    {
        $this->firestore = app('firebase.firestore');
    }

    public function all()
    {
        $documents = $this->firestore->collection($this->collection)->documents();
        $kandidats = [];

        foreach ($documents as $document) {
            if ($document->exists()) {
                $data = $document->data();
                $data['id'] = $document->id();
                $kandidats[] = $data;
            }
        }

        return collect($kandidats);
    }

    public function find($id)
    {
        $document = $this->firestore->collection($this->collection)->document($id)->snapshot();

        if ($document->exists()) {
            $data = $document->data();
            $data['id'] = $document->id();
            return $data;
        }

        return null;
    }

    public function create($data)
    {
        $data['created_at'] = new \DateTime();
        $data['updated_at'] = new \DateTime();

        $docRef = $this->firestore->collection($this->collection)->add($data);
        return $docRef->id();
    }

    public function update($id, $data)
    {
        $data['updated_at'] = new \DateTime();

        $this->firestore->collection($this->collection)
            ->document($id)
            ->update($data);

        return true;
    }

    public function delete($id)
    {
        $this->firestore->collection($this->collection)
            ->document($id)
            ->delete();

        return true;
    }

    public function putra()
    {
        $documents = $this->firestore->collection($this->collection)
            ->where('jenis_kelamin', '=', 'Laki-laki')
            ->documents();

        $kandidats = [];
        foreach ($documents as $document) {
            if ($document->exists()) {
                $data = $document->data();
                $data['id'] = $document->id();
                $kandidats[] = $data;
            }
        }

        return collect($kandidats);
    }

    public function putri()
    {
        $documents = $this->firestore->collection($this->collection)
            ->where('jenis_kelamin', '=', 'Perempuan')
            ->documents();

        $kandidats = [];
        foreach ($documents as $document) {
            if ($document->exists()) {
                $data = $document->data();
                $data['id'] = $document->id();
                $kandidats[] = $data;
            }
        }

        return collect($kandidats);
    }

    public function count()
    {
        $documents = $this->firestore->collection($this->collection)->documents();
        $count = 0;
        foreach ($documents as $document) {
            if ($document->exists()) {
                $count++;
            }
        }
        return $count;
    }
}