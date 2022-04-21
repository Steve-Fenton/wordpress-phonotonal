$compress = @{
    Path = "$PSScriptRoot\src\*"
    CompressionLevel = "Fastest"
    DestinationPath = "$PSScriptRoot\phonotonal.zip"
}

Compress-Archive @compress