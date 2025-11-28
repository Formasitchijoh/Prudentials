<?php

namespace App\Domains\Shared\Controllers;

use App\Http\Controllers\Controller;

use App\Domains\Shared\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index()
    {
        $documents = $this->documentService->getDocuments();
        return response()->json($documents);
    }

    public function store(Request $request)
    {
        $this->documentService->create($request);
        return response()->json(['message' => "Document stored successfully"]);
    }
}
