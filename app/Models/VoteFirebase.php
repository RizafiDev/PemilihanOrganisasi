<?php

namespace App\Models;

use Google\Cloud\Firestore\FirestoreClient;

class VoteFirebase
{
    protected $firestore;
    protected $collection = 'votes';

    public function __construct()
    {
        $this->firestore = app('firebase.firestore');
    }

    public function create($data)
    {
        $data['created_at'] = new \DateTime();
        $data['updated_at'] = new \DateTime();

        $docRef = $this->firestore->collection($this->collection)->add($data);
        return $docRef->id();
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

    public function findByVoterIdentifier($voterIdentifier)
    {
        $documents = $this->firestore->collection($this->collection)
            ->where('voter_identifier', '=', $voterIdentifier)
            ->documents();

        foreach ($documents as $document) {
            if ($document->exists()) {
                $data = $document->data();
                $data['id'] = $document->id();
                return $data;
            }
        }

        return null;
    }

    public function getVotesByKandidatAndJabatan($kandidatId, $jabatan)
    {
        $documents = $this->firestore->collection($this->collection)
            ->where('kandidat_id', '=', $kandidatId)
            ->where('jabatan_dipilih', '=', $jabatan)
            ->documents();

        $count = 0;
        foreach ($documents as $document) {
            if ($document->exists()) {
                $count++;
            }
        }

        return $count;
    }
}