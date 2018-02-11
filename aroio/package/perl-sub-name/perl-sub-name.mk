################################################################################
#
# perl-sub-name
#
################################################################################

PERL_SUB_NAME_VERSION = 0.21
PERL_SUB_NAME_SOURCE = Sub-Name-$(PERL_SUB_NAME_VERSION).tar.gz
PERL_SUB_NAME_SITE = $(BR2_CPAN_MIRROR)/authors/id/E/ET/ETHER
PERL_SUB_NAME_LICENSE = Artistic or GPL-1.0+
PERL_SUB_NAME_LICENSE_FILES = README

$(eval $(perl-package))
