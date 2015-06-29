#ifndef UIDPLUGIN_H
#define UIDPLUGIN_H

#include <iostream>
#include <curl/curl.h>
#include <libxml2/libxml/parser.h>
#include <libxml2/libxml/tree.h>

class UIDUtils {

	public:
		void http_post(std::string,std::string);
};

#endif
