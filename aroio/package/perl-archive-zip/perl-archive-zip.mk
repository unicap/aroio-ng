################################################################################
#
# perl-archive-zip
#
################################################################################

PERL_ARCHIVE_ZIP_VERSION = 1.60
PERL_ARCHIVE_ZIP_SOURCE = Archive-Zip-$(PERL_ARCHIVE_ZIP_VERSION).tar.gz
PERL_ARCHIVE_ZIP_SITE = $(BR2_CPAN_MIRROR)/authors/id/P/PH/PHRED
PERL_ARCHIVE_ZIP_LICENSE = Artistic or GPL-1.0+

$(eval $(perl-package))
