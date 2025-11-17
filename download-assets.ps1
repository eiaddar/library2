# Create necessary directories
$directories = @(
    "public/css/fonts",
    "public/css/font-awesome/webfonts",
    "public/js/lib/apexcharts",
    "public/js/lib/bootstrap",
    "public/js/lib/jsvectormap",
    "public/js/lib/overlayscrollbars",
    "public/js/lib/popper",
    "public/js/lib/jquery"
)

foreach ($dir in $directories) {
    if (!(Test-Path -Path $dir)) {
        New-Item -ItemType Directory -Force -Path $dir | Out-Null
        Write-Host "Created directory: $dir"
    }
}

# Download jQuery
Write-Host "Downloading jQuery..."
Invoke-WebRequest -Uri "https://code.jquery.com/jquery-3.7.1.min.js" -OutFile "public/js/lib/jquery/jquery-3.7.1.min.js"

# Download Popper.js
Write-Host "Downloading Popper.js..."
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" -OutFile "public/js/lib/popper/popper.min.js"

# Download Bootstrap
Write-Host "Downloading Bootstrap..."
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" -OutFile "public/js/lib/bootstrap/bootstrap.bundle.min.js"

# Download OverlayScrollbars
Write-Host "Downloading OverlayScrollbars..."
Invoke-WebRequest -Uri "https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/js/OverlayScrollbars.min.js" -OutFile "public/js/lib/overlayscrollbars/OverlayScrollbars.min.js"
Invoke-WebRequest -Uri "https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/css/OverlayScrollbars.min.css" -OutFile "public/css/overlayscrollbars/OverlayScrollbars.min.css"

# Download Font Awesome
Write-Host "Downloading Font Awesome..."
Invoke-WebRequest -Uri "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" -OutFile "public/css/font-awesome/css/all.min.css"
Invoke-WebRequest -Uri "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/webfonts/fa-solid-900.woff2" -OutFile "public/css/font-awesome/webfonts/fa-solid-900.woff2"
Invoke-WebRequest -Uri "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/webfonts/fa-regular-400.woff2" -OutFile "public/css/font-awesome/webfonts/fa-regular-400.woff2"
Invoke-WebRequest -Uri "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/webfonts/fa-brands-400.woff2" -OutFile "public/css/font-awesome/webfonts/fa-brands-400.woff2"

# Download Source Sans 3 font
Write-Host "Downloading Source Sans 3 font..."
if (!(Test-Path -Path "public/css/fonts/source-sans-3.css")) {
    @"
/* source-sans-3-300 - latin */
@font-face {
  font-display: swap;
  font-family: 'Source Sans 3';
  font-style: normal;
  font-weight: 300;
  src: url('./source-sans-3-latin-300.woff2') format('woff2');
}

/* source-sans-3-regular - latin */
@font-face {
  font-display: swap;
  font-family: 'Source Sans 3';
  font-style: normal;
  font-weight: 400;
  src: url('./source-sans-3-latin-regular.woff2') format('woff2');
}

/* source-sans-3-italic - latin */
@font-face {
  font-display: swap;
  font-family: 'Source Sans 3';
  font-style: italic;
  font-weight: 400;
  src: url('./source-sans-3-latin-italic.woff2') format('woff2');
}

/* source-sans-3-700 - latin */
@font-face {
  font-display: swap;
  font-family: 'Source Sans 3';
  font-style: normal;
  font-weight: 700;
  src: url('./source-sans-3-latin-700.woff2') format('woff2');
}
"@ | Out-File -FilePath "public/css/fonts/source-sans-3.css" -Encoding utf8
}

# Download font files
Invoke-WebRequest -Uri "https://fonts.gstatic.com/s/sourcesans3/v15/nwpBtKy2OAdR1K-IwhWudF-RVQAoprVoQILlTZw.woff2" -OutFile "public/css/fonts/source-sans-3-latin-300.woff2"
Invoke-WebRequest -Uri "https://fonts.gstatic.com/s/sourcesans3/v15/nwpCtKy2OAdR1K-IwhWudF-RVQAoprVoK7I.woff2" -OutFile "public/css/fonts/source-sans-3-latin-regular.woff2"
Invoke-WebRequest -Uri "https://fonts.gstatic.com/s/sourcesans3/v15/nwpBtKy2OAdR1K-IwhWudF-RVQAoprVoQILlTZw.woff2" -OutFile "public/css/fonts/source-sans-3-latin-italic.woff2"
Invoke-WebRequest -Uri "https://fonts.gstatic.com/s/sourcesans3/v15/nwpBtKy2OAdR1K-IwhWudF-RVQAoprVoQILlTZw.woff2" -OutFile "public/css/fonts/source-sans-3-latin-700.woff2"

# Download ApexCharts
Write-Host "Downloading ApexCharts..."
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/apexcharts" -OutFile "public/js/lib/apexcharts/apexcharts.min.js"

# Download jsvectormap
Write-Host "Downloading jsvectormap..."
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/jsvectormap" -OutFile "public/js/lib/jsvectormap/jsvectormap.min.js"
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/jsvectormap/dist/css/jsvectormap.min.css" -OutFile "public/js/lib/jsvectormap/jsvectormap.min.css"

Write-Host "All assets have been downloaded and organized successfully!"
