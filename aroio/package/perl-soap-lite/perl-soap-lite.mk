################################################################################
#
# perl-soap_lite
#
################################################################################

PERL_SOAP_LITE_VERSION = 1.20
PERL_SOAP_LITE_SOURCE = SOAP-Lite-$(PERL_SOAP_LITE_VERSION).tar.gz
PERL_SOAP_LITE_SITE = $(BR2_CPAN_MIRROR)/authors/id/P/PH/PHRED
PERL_SOAP_LITE_LICENSE = Artistic or GPLv1+
PERL_SOAP_LITE_LICENSE_FILES = README

$(eval $(perl-package))
