################################################################################
#
# perl-file-next
#
################################################################################

PERL_FILE_NEXT_VERSION = 1.16
PERL_FILE_NEXT_SOURCE = File-Next-$(PERL_FILE_NEXT_VERSION).tar.gz
PERL_FILE_NEXT_SITE = $(BR2_CPAN_MIRROR)/authors/id/P/PE/PETDANCE
PERL_FILE_NEXT_LICENSE = Artistic-2.0

$(eval $(perl-package))
