<?php
	require_once 'config.php';
	if(isset($_GET['packages'])) {
		try {
			// Generate Packages.bz2
			header("Content-Type: application/x-bzip2");
			header("Content-Disposition: filename=\"Packages.bz2\"");
			header("Content-Length: " . $size);
			readfile("Packages.bz2");	
	
		} catch(Exception $e) {
			header('HTTP/1.1 500');
			die($e->getMessage());
		}
	} elseif(isset($_GET['release'])) {
		try {
			// Generate release
			$release = "Origin: ".$aGlobalConfig['releasesConfig']['Origin']."\n";
			$release .= "Label: ".$aGlobalConfig['releasesConfig']['Label']."\n";
			$release .= "Suite: ".$aGlobalConfig['releasesConfig']['Suite']."\n";
			$release .= "Version: ".$aGlobalConfig['releasesConfig']['Version']."\n";
			$release .= "Codename: ".$aGlobalConfig['releasesConfig']['Codename']."\n";
			$release .= "Architectures: ".$aGlobalConfig['releasesConfig']['Architectures']."\n";
			$release .= "Components: ".$aGlobalConfig['releasesConfig']['Components']."\n";
			$release .= "Description: ".$aGlobalConfig['releasesConfig']['Description']."\n\n";
			
			header('HTTP/1.1 200 OK');
			header('Content-Type: text/plain; charset=utf-8');
			header('Content-Disposition: filename="Release"');
			header('Content-Length: ' . strlen($release));
			die($release);
		} catch(Exception $e) {
			header('HTTP/1.1 500');
			die($e->getMessage());
		}
	} else {
		header('HTTP/1.1 500');
		header('Content-Type: text/plain; charset=utf-8');
		die("Call invalid.");
	}
?>