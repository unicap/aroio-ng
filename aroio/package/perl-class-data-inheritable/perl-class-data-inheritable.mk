################################################################################
#
# perl-class-data-inheritable
#
################################################################################

PERL_CLASS_DATA_INHERITABLE_VERSION = 0.08
PERL_CLASS_DATA_INHERITABLE_SOURCE = Class-Data-Inheritable-$(PERL_CLASS_DATA_INHERITABLE_VERSION).tar.gz
PERL_CLASS_DATA_INHERITABLE_SITE = $(BR2_CPAN_MIRROR)/authors/id/T/TM/TMTM
PERL_CLASS_DATA_INHERITABLE_LICENSE = Artistic or GPL-1.0+
PERL_CLASS_DATA_INHERITABLE_LICENSE_FILES = README

$(eval $(perl-package))
