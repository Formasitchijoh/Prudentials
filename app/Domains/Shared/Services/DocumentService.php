<?php

namespace App\Domains\Shared\Services;

use App\Domains\Shared\Repositories\DocumentRepository;
use Illuminate\Http\Request;

class DocumentService
{
    protected $documentRepository;

    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function getDocuments()
    {
        return $this->documentRepository->getAllDocuments();
    }

    public function create(Request $request)
    {
        return $this->documentRepository->create($request);
    }
}