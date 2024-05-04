function downloadPaperMCmain($version, $uuid){
    $builds = "https://api.papermc.io/v2/projects/paper/versions/{$version}/builds/";
    

$PROJECT = "paper";
$MINECRAFT_VERSION = $version;

$latestVersionData = json_decode(file_get_contents("https://api.papermc.io/v2/projects/{$PROJECT}"), true);
$LATEST_VERSION = end($latestVersionData['versions']);

$latestBuildData = json_decode(file_get_contents("https://api.papermc.io/v2/projects/{$PROJECT}/versions/{$MINECRAFT_VERSION}/builds"), true);
$filteredBuilds = array_filter($latestBuildData['builds'], function($build) {
    return $build['channel'] == 'default';
});

$LATEST_BUILD = end($filteredBuilds)['build'];

$JAR_NAME = "{$PROJECT}-{$LATEST_VERSION}-{$LATEST_BUILD}.jar";

$PAPERMC_URL = "https://api.papermc.io/v2/projects/{$PROJECT}/versions/{$LATEST_VERSION}/builds/{$LATEST_BUILD}/downloads/{$JAR_NAME}";

// Create the directory if it doesn't exist
$directory = "../SERVERS/{$uuid}/Server/";
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

// Download the latest PaperMC version and save it in the specified directory
file_put_contents("../SERVERS/{$uuid}/Server/server.jar", file_get_contents($PAPERMC_URL));
echo "Downloads completed\n";




}
