<?php

namespace Qbil\ReadSoftOnline\Models;

class Document
{
    public $Id;
    public $Version;
    public $Type;
    public $OriginalFilename;
    public $Filename;
    public $Parties;
    public $HeaderFields;
    public $Tables;
    public $ProcessMessages;
    public $SystemFields;
    public $AccountingInformation;
    public $ErpCorrelationData;
    public $BaseType;
    public $Permalink;
    public $History;
    public $TrackId;
    public $DocumentType;
    public $ValidationInfoCollection;
    public $Origin;
    public $EmbeddedImage;
    public $DocumentSubType;

    public function __construct(array $document)
    {
        $this->Id = $document['Id'];
        $this->Version = $document['Version'];
        $this->Type = $document['Type'];
        $this->OriginalFilename = $document['OriginalFilename'];
        $this->Filename = $document['Filename'];
        $this->Parties = $document['Parties'];
        $this->HeaderFields = $document['HeaderFields'];
        $this->Tables = $document['Tables'];
        $this->ProcessMessages = $document['ProcessMessages'];
        $this->SystemFields = $document['SystemFields'];
        $this->AccountingInformation = $document['AccountingInformation'];
        $this->ErpCorrelationData = $document['ErpCorrelationData'];
        $this->BaseType = $document['BaseType'];
        $this->Permalink = $document['Permalink'];
        $this->History = $document['History'];
        $this->TrackId = $document['TrackId'];
        $this->DocumentType = $document['DocumentType'];
        $this->ValidationInfoCollection = $document['ValidationInfoCollection'];
        $this->Origin = $document['Origin'];
        $this->EmbeddedImage = $document['EmbeddedImage'];
        $this->DocumentSubType = $document['DocumentSubType'];
    }
}
