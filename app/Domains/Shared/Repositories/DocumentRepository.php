<?php

namespace App\Domains\Shared\Repositories;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use App\Domains\Shared\Models\Document;
use Illuminate\Support\Facades\Log;

class DocumentRepository
{

    public function getAllDocuments()
    {
        return Document::latest()->get();
    }

    public function create(Request $request)
    {
        Log::info($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'user_id' => 'required|exists:users,id',
            'document_file' => [
                'required',
                File::types(['pdf', 'doc', 'docx', 'csv'])->max(2048)
            ],
            'tenant_id' => 'required|exists:tenants,id',
            'documentable_id' => 'required|numeric',
            'documentable_type' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        // Handle the file upload using the validated file object
        // The store method returns the path where the file was saved

        $documentPath = $request->file('document_file')->store('documents', 'public');

        return Document::create([
            'name' => $validatedData['name'],
            'storage_path' => $documentPath,
            'tenant_id' => $validatedData['tenant_id'],
            'documentable_id' => $validatedData['documentable_id'],
            'documentable_type' => $validatedData['documentable_type'],
            'user_id' => $validatedData['user_id'],
        ]);
    }

}
