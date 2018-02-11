################################################################################
#
# perl-file-bom
#
################################################################################

PERL_FILE_BOM_VERSION = 0.15
PERL_FILE_BOM_SOURCE = File-BOM-$(PERL_FILE_BOM_VERSION).tar.gz
PERL_FILE_BOM_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/MA/MATTLAW
PERL_FILE_BOM_DEPENDENCIES = host-perl-module-build perl-readonly
PERL_FILE_BOM_LICENSE = Artistic or GPL-1.0+
PERL_FILE_BOM_LICENSE_FILES = README

$(eval $(perl-package))
