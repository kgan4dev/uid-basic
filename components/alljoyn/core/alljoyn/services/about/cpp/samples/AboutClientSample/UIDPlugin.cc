#include "UIDPlugin.h"

void UIDUtils::http_post(std::string uri,std::string payLoad)
{	
	CURL *AJcurl = curl_easy_init();

	if(AJcurl) {
        	curl_easy_setopt(AJcurl, CURLOPT_URL, uri.c_str());

        	/* use a GET to fetch this */
	        curl_easy_setopt(AJcurl,CURLOPT_POSTFIELDS,payLoad.c_str());

        	/* Perform the request, res will get the return code */
	        if(curl_easy_perform(AJcurl))
			std::cerr << "curl_easy_perform() failed"<< std::endl;

	        /* always cleanup */
        	curl_easy_cleanup(AJcurl);
    	}
	
	curl_global_cleanup();
}
